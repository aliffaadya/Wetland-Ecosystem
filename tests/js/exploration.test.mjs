import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';

const blade = readFileSync(new URL('../../resources/views/pages/exploration.blade.php', import.meta.url), 'utf8');
const script = readFileSync(new URL('../../public/js/exploration.js', import.meta.url), 'utf8');

class Element {
  constructor(id = '') {
    this.id = id;
    this.hidden = id === 'infoPopup' || id === 'popupImage' || id === 'ecosystemComplete';
    this.textContent = '';
    this.dataset = {};
    this.attributes = {};
    this.style = {};
    this.listeners = {};
    this.classes = new Set();
    this.classList = {
      add: name => this.classes.add(name),
      remove: name => this.classes.delete(name),
      contains: name => this.classes.has(name),
      toggle: (name, force) => {
        const add = force ?? !this.classes.has(name);
        if (add) this.classes.add(name); else this.classes.delete(name);
        return add;
      },
    };
  }
  addEventListener(type, callback) { (this.listeners[type] ??= []).push(callback); }
  dispatch(type, event = {}) { for (const callback of this.listeners[type] ?? []) callback({ target: this, ...event }); }
  setAttribute(name, value) { this.attributes[name] = value; }
  focus() { this.focused = true; }
  querySelectorAll(selector) { return selector === 'a' ? (this.links ?? []) : []; }
}

function createPage() {
  const ids = ['mobileNavToggle', 'mainNavigation', 'infoPopup', 'closePopup', 'popupTitle', 'popupImage', 'popupDescription', 'popupTraits', 'popupRole', 'ecosystemCount', 'ecosystemFill', 'ecosystemComplete', 'overallCount', 'overallFill', 'completedEcosystems', 'saveWarning'];
  const elements = Object.fromEntries(ids.map(id => [id, new Element(id)]));
  elements.mainNavigation.links = Array.from({ length: 5 }, () => new Element('navLink'));
  elements.completedEcosystems.dataset.count = '0';
  const hotspots = ['air-rawa', 'tumbuhan-rawa', 'burung-air'].map(key => {
    const button = new Element('hotspot');
    button.dataset.hotspot = key;
    return button;
  });
  const ecosystemBar = new Element('ecosystemBar');
  const overallBar = new Element('overallBar');
  const documentListeners = {};
  const document = {
    getElementById: id => elements[id],
    querySelector: selector => ({
      '.ecosystem-progress [role="progressbar"]': ecosystemBar,
      '.overall-progress [role="progressbar"]': overallBar,
      'meta[name="csrf-token"]': { content: 'test-token' },
    })[selector] ?? null,
    querySelectorAll: selector => selector === '.hotspot' ? hotspots : [],
    addEventListener(type, callback) { (documentListeners[type] ??= []).push(callback); },
    dispatch(type, event = {}) { for (const callback of documentListeners[type] ?? []) callback(event); },
  };
  let timerId = 0;
  const timers = new Map();
  const setTimeout = callback => { const id = ++timerId; timers.set(id, callback); return id; };
  const clearTimeout = id => timers.delete(id);
  const fetchCalls = [];
  const fetch = async (url, options) => {
    fetchCalls.push({ url, options });
    return { ok: true, json: async () => ({ ecosystemComplete: fetchCalls.length === 3 }) };
  };
  const window = {
    WETLAND_EXPLORATION_DATA: {
      ecosystem: 'rawa', overallVisited: 0, overallTotal: 11, totalEcosystems: 4, saveUrl: '/learning-progress/exploration',
      hotspots: Object.fromEntries(hotspots.map(button => [button.dataset.hotspot, {
        label: button.dataset.hotspot, title: button.dataset.hotspot, description: 'Deskripsi', traits: 'Ciri', role: 'Peran', image_url: `/images/${button.dataset.hotspot}.jpeg`, visited: false,
      }])),
    },
  };
  new Function('document', 'window', 'fetch', 'setTimeout', 'clearTimeout', script)(document, window, fetch, setTimeout, clearTimeout);
  return {
    elements, hotspots, ecosystemBar, overallBar, fetchCalls,
    flushTimers() { for (const callback of timers.values()) callback(); timers.clear(); },
    pressEscape() { document.dispatch('keydown', { key: 'Escape' }); },
    clickBackdrop() { elements.infoPopup.dispatch('click', { target: elements.infoPopup }); },
  };
}

const nextTick = () => new Promise(resolve => setTimeout(resolve, 0));

test('hotspots open matching information and each unique visit is recorded once', async () => {
  const page = createPage();
  const { elements, hotspots } = page;
  assert.equal(elements.ecosystemCount.textContent, '0 dari 3');
  assert.equal(page.ecosystemBar.attributes['aria-valuenow'], 0);
  for (const hotspot of hotspots) {
    hotspot.dispatch('click');
    assert.equal(elements.popupTitle.textContent, hotspot.dataset.hotspot);
    assert.equal(elements.popupImage.src, `/images/${hotspot.dataset.hotspot}.jpeg`);
    assert.equal(elements.popupDescription.textContent, 'Deskripsi');
    assert.equal(elements.popupTraits.textContent, 'Ciri');
    assert.equal(elements.popupRole.textContent, 'Peran');
    assert.equal(hotspot.attributes['aria-pressed'], 'true');
  }
  assert.equal(elements.ecosystemCount.textContent, '3 dari 3');
  assert.equal(elements.ecosystemComplete.hidden, false);
  hotspots[0].dispatch('click');
  await nextTick();
  assert.equal(page.fetchCalls.length, 3);
  assert.equal(elements.overallCount.textContent, '3 dari 11 objek · 1 dari 4 ekosistem');
  assert.equal(elements.completedEcosystems.dataset.count, '1');
});

test('popup closes with its close button, Escape, and backdrop', () => {
  for (const close of [page => page.elements.closePopup.dispatch('click'), page => page.pressEscape(), page => page.clickBackdrop()]) {
    const page = createPage();
    page.hotspots[0].dispatch('click');
    close(page);
    assert.equal(page.elements.infoPopup.classList.contains('closing'), true);
    page.flushTimers();
    assert.equal(page.elements.infoPopup.hidden, true);
    assert.equal(page.hotspots[0].focused, true);
  }
});

test('hotspots scale with the natural-size image and layout has a mobile breakpoint', () => {
  assert.match(blade, /\.scene\{[^}]*position:relative/s);
  assert.match(blade, /\.scene-image\{[^}]*width:100%;height:auto/s);
  assert.match(blade, /\.hotspot\{[^}]*left:var\(--x\);top:var\(--y\)/s);
  assert.match(blade, /@media\(max-width:650px\)/);
});

test('mobile navigation opens, exposes its state, and closes after choosing a link', () => {
  const page = createPage();
  page.elements.mobileNavToggle.dispatch('click');
  assert.equal(page.elements.mainNavigation.classList.contains('open'), true);
  assert.equal(page.elements.mobileNavToggle.attributes['aria-expanded'], 'true');
  page.elements.mainNavigation.links[0].dispatch('click');
  assert.equal(page.elements.mainNavigation.classList.contains('open'), false);
  assert.equal(page.elements.mobileNavToggle.attributes['aria-expanded'], 'false');
});
