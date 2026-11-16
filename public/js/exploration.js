(() => {
  const navigationToggle = document.getElementById('mobileNavToggle');
  const navigation = document.getElementById('mainNavigation');

  if (navigationToggle && navigation) {
    navigationToggle.addEventListener('click', () => {
      const isOpen = navigation.classList.toggle('open');
      navigationToggle.setAttribute('aria-expanded', String(isOpen));
      navigationToggle.setAttribute('aria-label', isOpen ? 'Tutup navigasi' : 'Buka navigasi');
    });
    navigation.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
      navigation.classList.remove('open');
      navigationToggle.setAttribute('aria-expanded', 'false');
    }));
  }

  const data = window.WETLAND_EXPLORATION_DATA;
  if (!data) return;

  const modal = document.getElementById('infoPopup');
  const closeButton = document.getElementById('closePopup');
  const hotspotButtons = [...document.querySelectorAll('.hotspot')];
  const visited = new Set(Object.entries(data.hotspots).filter(([, item]) => item.visited).map(([key]) => key));
  const persisted = new Set(visited);
  const saving = new Set();
  let overallVisited = Number(data.overallVisited);
  let ecosystemWasComplete = visited.size === Object.keys(data.hotspots).length;
  let opener = null;
  let closeTimer;

  function renderProgress() {
    const count = visited.size;
    const total = Object.keys(data.hotspots).length;
    const countElement = document.getElementById('ecosystemCount');
    const fill = document.getElementById('ecosystemFill');
    const bar = document.querySelector('.ecosystem-progress [role="progressbar"]');
    const completedMessage = document.getElementById('ecosystemComplete');

    countElement.textContent = `${count} dari ${total}`;
    fill.style.width = `${count / total * 100}%`;
    bar.setAttribute('aria-valuenow', count);
    completedMessage.hidden = count !== total;
    hotspotButtons.forEach(button => {
      const isVisited = visited.has(button.dataset.hotspot);
      button.classList.toggle('visited', isVisited);
      button.setAttribute('aria-pressed', String(isVisited));
      button.setAttribute('aria-label', `${data.hotspots[button.dataset.hotspot].label}${isVisited ? ', sudah dijelajahi' : ''}`);
    });
  }

  function renderOverallProgress() {
    const count = document.getElementById('overallCount');
    const fill = document.getElementById('overallFill');
    const bar = document.querySelector('.overall-progress [role="progressbar"]');
    count.textContent = `${overallVisited} dari ${data.overallTotal} objek · ${document.getElementById('completedEcosystems').textContent}`;
    fill.style.width = `${overallVisited / data.overallTotal * 100}%`;
    bar.setAttribute('aria-valuenow', overallVisited);
  }

  function saveVisit(key) {
    if (persisted.has(key) || saving.has(key)) return;
    saving.add(key);
    fetch(`${data.saveUrl}/${encodeURIComponent(data.ecosystem)}/${encodeURIComponent(key)}`, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
      }
    }).then(response => {
      if (!response.ok) throw new Error('Progress belum tersimpan.');
      return response.json();
    }).then(result => {
      persisted.add(key);
      overallVisited = Math.min(overallVisited + 1, data.overallTotal);
      if (result.ecosystemComplete && !ecosystemWasComplete) {
        ecosystemWasComplete = true;
        const doneCount = document.getElementById('completedEcosystems');
        const current = Number(doneCount.dataset.count) + 1;
        doneCount.dataset.count = String(current);
        doneCount.textContent = `${current} dari ${data.totalEcosystems} ekosistem`;
      }
      document.getElementById('saveWarning').textContent = '';
      renderOverallProgress();
    }).catch(error => {
      document.getElementById('saveWarning').textContent = 'Progres belum tersimpan. Klik penanda ini lagi untuk mencoba kembali.';
      console.error('Wetland Explorer:', error);
    }).finally(() => saving.delete(key));
  }

  function openPopup(button) {
    const key = button.dataset.hotspot;
    const item = data.hotspots[key];
    opener = button;
    document.getElementById('popupTitle').textContent = item.title;
    const image = document.getElementById('popupImage');
    image.src = item.image_url;
    image.alt = item.title;
    image.hidden = false;
    const imageSource = document.getElementById('popupImageSource');
    if (item.photo_credit) {
      const credit = item.photo_credit;
      imageSource.replaceChildren();
      imageSource.append('Sumber foto: ');
      const link = document.createElement('a');
      link.href = credit.source;
      link.target = '_blank';
      link.rel = 'noopener noreferrer';
      link.textContent = credit.title;
      imageSource.append(link, ` — ${credit.photographer}; ${credit.license}.`);
      imageSource.hidden = false;
    } else {
      imageSource.replaceChildren();
      imageSource.hidden = true;
    }
    document.getElementById('popupDescription').textContent = item.description;
    document.getElementById('popupTraits').textContent = item.traits;
    document.getElementById('popupRole').textContent = item.role;

    if (!visited.has(key)) visited.add(key);
    renderProgress();
    saveVisit(key);
    clearTimeout(closeTimer);
    modal.hidden = false;
    modal.classList.remove('closing');
    closeButton.focus();
  }

  function closePopup() {
    if (modal.hidden || modal.classList.contains('closing')) return;
    modal.classList.add('closing');
    closeTimer = setTimeout(() => {
      modal.hidden = true;
      modal.classList.remove('closing');
      opener?.focus();
    }, 180);
  }

  hotspotButtons.forEach(button => button.addEventListener('click', () => openPopup(button)));
  closeButton.addEventListener('click', closePopup);
  modal.addEventListener('click', event => { if (event.target === modal) closePopup(); });
  document.addEventListener('keydown', event => { if (event.key === 'Escape') closePopup(); });
  renderProgress();
})();
