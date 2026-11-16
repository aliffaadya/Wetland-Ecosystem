
/* =========================================================
   WETLAND EXPLORER
   TUTORIAL PAGE ENGINE
   Kelas VII SMP
   ========================================================= */

let TUT_TOPICS = [];
let TUT_ACTIVE = null;
let TUT_ANSWERS = {};
let TUT_QUESTION_INDEX = 0;
let TUT_SUBMITTED = false;


/* =========================================================
   PROGRESS STORE
   ========================================================= */

const ProgressStore = {
  key: "wetlandExplorerLearningProgress",

  getData() {
    try {
      const data = JSON.parse(localStorage.getItem(this.key));

      return {
        completed: Array.isArray(data?.completed)
          ? data.completed
          : [],
        quizScores: data?.quizScores || {}
      };
    } catch (error) {
      return {
        completed: [],
        quizScores: {}
      };
    }
  },

  saveData(data) {
    localStorage.setItem(this.key, JSON.stringify(data));
  },

  isTopicComplete(topicId) {
    return this.getData().completed.includes(topicId);
  },

  markTopicComplete(topicId) {
    const data = this.getData();

    if (!data.completed.includes(topicId)) {
      data.completed.push(topicId);
    }

    this.saveData(data);
  },

  recordQuizScore(topicId, correct, total) {
    const data = this.getData();

    data.quizScores[topicId] = {
      correct,
      total,
      percentage: total > 0
        ? Math.round((correct / total) * 100)
        : 0,
      date: new Date().toISOString()
    };

    this.saveData(data);
  },

  getCompletedCount() {
    return this.getData().completed.length;
  }
};


/* =========================================================
   HELPER
   ========================================================= */

function escapeHtml(value) {
  return String(value ?? "").replace(/[&<>"']/g, char => {
    const entities = {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#039;"
    };

    return entities[char];
  });
}


function getTopicFromURL() {
  const params = new URLSearchParams(window.location.search);
  return params.get("topic");
}


function updateTopicURL(topicId) {
  const url = new URL(window.location.href);

  url.searchParams.set("topic", topicId);

  window.history.replaceState({}, "", url);
}


function showToast(message) {
  let toast = document.getElementById("wetlandToast");

  if (!toast) {
    toast = document.createElement("div");
    toast.id = "wetlandToast";
    toast.className = "wetland-toast";
    document.body.appendChild(toast);
  }

  toast.textContent = message;
  toast.classList.add("show");

  clearTimeout(toast.timer);

  toast.timer = setTimeout(() => {
    toast.classList.remove("show");
  }, 2500);
}


/* =========================================================
   CETAK / SIMPAN PDF
   ========================================================= */

function downloadLessonPDF() {
  window.print();
}


/* =========================================================
   INITIALIZATION
   ========================================================= */

function initTutorialPage() {
  const sidebar = document.getElementById("tutSidebarList");
  const content = document.getElementById("tutContentBody");

  if (!sidebar || !content) return;

  try {
    if (
      !window.TUTORIALS_DATA ||
      !Array.isArray(window.TUTORIALS_DATA.topics)
    ) {
      throw new Error("Data materi tidak berhasil dimuat.");
    }

    TUT_TOPICS = window.TUTORIALS_DATA.topics;

    if (TUT_TOPICS.length === 0) {
      throw new Error("Belum ada materi pembelajaran.");
    }

    const requestedTopic = getTopicFromURL();

    TUT_ACTIVE = TUT_TOPICS.some(
      topic => topic.id === requestedTopic
    )
      ? requestedTopic
      : TUT_TOPICS[0].id;

    renderSidebar();
    renderLesson(TUT_ACTIVE);

  } catch (error) {
    content.innerHTML = `
            <div class="tut-error">
                <h3>Materi belum dapat ditampilkan</h3>
                <p>${escapeHtml(error.message)}</p>
                <p>Periksa kembali file data-tutorials.js.</p>
            </div>
        `;

    console.error("Wetland Explorer:", error);
  }
}


/* =========================================================
   SIDEBAR MATERI
   ========================================================= */

function renderSidebar() {
  const list = document.getElementById("tutSidebarList");

  if (!list) return;

  list.innerHTML = "";

  TUT_TOPICS.forEach(topic => {
    const completed = ProgressStore.isTopicComplete(topic.id);

    const button = document.createElement("button");

    button.type = "button";
    button.className = "tut-topic-btn";

    if (topic.id === TUT_ACTIVE) {
      button.classList.add("active");
    }

    button.innerHTML = `
            <span class="n">
                ${String(topic.number).padStart(2, "0")}
            </span>

            <span class="topic-name">
                ${escapeHtml(topic.title)}
            </span>

            ${completed
        ? '<span class="topic-check" aria-label="Selesai">✓</span>'
        : ""}
        `;

    button.addEventListener("click", () => {
      openTopic(topic.id);
    });

    list.appendChild(button);
  });
}


function openTopic(topicId) {
  TUT_ACTIVE = topicId;
  TUT_ANSWERS = {};
  TUT_QUESTION_INDEX = 0;
  TUT_SUBMITTED = false;

  updateTopicURL(topicId);

  renderSidebar();
  renderLesson(topicId);

  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}


/* =========================================================
   RENDER LESSON
   ========================================================= */

function renderLesson(topicId) {
  const topic = TUT_TOPICS.find(item => item.id === topicId);
  const body = document.getElementById("tutContentBody");

  if (!topic || !body) return;

  const index = TUT_TOPICS.findIndex(item => item.id === topicId);

  const previous = TUT_TOPICS[index - 1];
  const next = TUT_TOPICS[index + 1];

  const completed = ProgressStore.isTopicComplete(topic.id);

  body.innerHTML = `
        <article class="wetland-lesson">

            <header class="lesson-header">

                <div class="lesson-kicker">
                    MATERI PEMBELAJARAN
                    <span>•</span>
                    MATERI ${topic.number}
                </div>

                <h1>
                    Materi ${topic.number}: ${escapeHtml(topic.title)}
                </h1>

                <p class="lesson-summary">
                    ${escapeHtml(topic.summary || "")}
                </p>

                <div class="lesson-meta">

                    <span>
                        <i class="fa-solid fa-book-open"></i>
                        Materi ${topic.number} dari ${TUT_TOPICS.length}
                    </span>

                    ${completed
      ? `
                            <span class="lesson-completed">
                                ✓ Sudah dipelajari
                            </span>
                        `
      : ""}

                    <button
                        type="button"
                        class="lesson-download no-print"
                        id="downloadLessonBtn">

                        <i class="fa-solid fa-download"></i>
                        Unduh PDF

                    </button>

                </div>

            </header>


            ${renderObjectives(topic)}


            <section class="lesson-material">
                ${renderLessonBlocks(topic.blocks || [])}
            </section>


            <section class="lesson-exercise" id="lessonExercise">

                <div class="exercise-heading">

                    <span class="exercise-icon">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>

                    <div>
                        <h2>Yuk, Berlatih!</h2>

                        <p>
                            Kerjakan soal berikut untuk menguji
                            pemahamanmu tentang materi ini.
                        </p>
                    </div>

                </div>

                ${renderExercises(topic)}

            </section>


            <nav class="lesson-navigation">

                <div class="lesson-navigation-prev">

                    ${previous ? `
                        <button
                            type="button"
                            class="lesson-nav-button previous"
                            id="prevTopicBtn">

                            <i class="fa-solid fa-arrow-left"></i>

                            <span>
                                <small>Materi sebelumnya</small>
                                <strong>${escapeHtml(previous.title)}</strong>
                            </span>

                        </button>
                    ` : ""}

                </div>


                <div class="lesson-navigation-next">

                    ${next ? `
                        <button
                            type="button"
                            class="lesson-nav-button next"
                            id="nextTopicBtn">

                            <span>
                                <small>Materi berikutnya</small>
                                <strong>${escapeHtml(next.title)}</strong>
                            </span>

                            <i class="fa-solid fa-arrow-right"></i>

                        </button>
                    ` : `
                        <a
                            href="${escapeHtml(window.WETLAND_DASHBOARD_URL || "/dashboard")}"
                            class="lesson-nav-button next">

                            <span>
                                <small>Pembelajaran selesai</small>
                                <strong>Kembali ke Dashboard</strong>
                            </span>

                            <i class="fa-solid fa-house"></i>

                        </a>
                    `}

                </div>

            </nav>

        </article>
    `;

  bindLessonNavigation(previous, next);
  bindDownloadButton();
  bindExerciseEvents(topic);
}


/* =========================================================
   TUJUAN PEMBELAJARAN
   ========================================================= */

function renderObjectives(topic) {
  if (!topic.objectives || topic.objectives.length === 0) {
    return "";
  }

  return `
        <section class="learning-objectives">

            <div class="objectives-title">
                <i class="fa-solid fa-bullseye"></i>
                <strong>Tujuan Pembelajaran</strong>
            </div>

            <div class="objectives-content">

                <p>
                    Setelah mempelajari materi ini, kamu diharapkan mampu:
                </p>

                <ul>
                    ${topic.objectives.map(objective => `
                        <li>${escapeHtml(objective)}</li>
                    `).join("")}
                </ul>

            </div>

        </section>
    `;
}


/* =========================================================
   RENDER BLOK MATERI
   ========================================================= */

function renderLessonBlocks(blocks) {
  return blocks.map(block => {
    switch (block.type) {
      case "paragraph":
        return renderParagraphBlock(block);

      case "image":
        return renderImageBlock(block);

      case "callout":
        return renderCalloutBlock(block);

      case "video":
        return renderVideoBlock(block);

      case "table":
        return renderTableBlock(block);

      case "diagram":
        return renderDiagramBlock(block);

      default:
        console.warn(
          "Jenis blok materi tidak dikenal:",
          block.type
        );

        return "";
    }
  }).join("");
}


/* =========================================================
   PARAGRAF
   ========================================================= */

function renderParagraphBlock(block) {
  const paragraphs = (block.content || []).map(paragraph => `
        <p>${escapeHtml(paragraph)}</p>
    `).join("");

  const list = block.list && block.list.length
    ? `
            <ul class="lesson-list">
                ${block.list.map(item => `
                    <li>${escapeHtml(item)}</li>
                `).join("")}
            </ul>
        `
    : "";

  return `
        <section class="lesson-section">

            ${block.heading
      ? `<h2>${escapeHtml(block.heading)}</h2>`
      : ""}

            <div class="lesson-text">
                ${paragraphs}
                ${list}
            </div>

        </section>
    `;
}


/* =========================================================
   GAMBAR
   ========================================================= */

function renderImageBlock(block) {
  if (!block.src) return "";

  return `
        <figure class="lesson-figure">

            <img
                src="${escapeHtml(block.src)}"
                alt="${escapeHtml(block.alt || "Ilustrasi lahan basah")}"
                loading="lazy"
                onerror="
                    this.closest('figure').classList.add('image-error');
                    this.style.display='none';
                "
            >

          <figcaption>
              ${escapeHtml(block.caption || "")}

              <span class="image-source">
                  Sumber:
                  <a
                      href="${escapeHtml(block.src)}"
                      target="_blank"
                      rel="noopener noreferrer"
                  >
                      Wikimedia Commons
                  </a>
              </span>
          </figcaption>

            <div class="image-fallback">
                Ilustrasi belum dapat dimuat.
            </div>

        </figure>
    `;
}


/* =========================================================
   CALLOUT / TAHUKAH KAMU
   ========================================================= */

function renderCalloutBlock(block) {
  return `
        <aside class="lesson-callout">

            <div class="callout-icon">
                <i class="fa-solid fa-lightbulb"></i>
            </div>

            <div class="callout-content">

                <h3>
                    ${escapeHtml(block.title || "Tahukah Kamu?")}
                </h3>

                <p>
                    ${escapeHtml(block.content || "")}
                </p>

            </div>

        </aside>
    `;
}


/* =========================================================
   VIDEO
   ========================================================= */

function renderVideoBlock(block) {
  if (!block.videoId && !block.src) return "";

  let videoUrl = "";

  if (block.videoId) {
    videoUrl =
      `https://www.youtube.com/embed/${encodeURIComponent(block.videoId)}`;
  } else {
    videoUrl = block.src;
  }

  return `
        <section class="lesson-video">

            ${block.heading
      ? `<h2>${escapeHtml(block.heading)}</h2>`
      : ""}

            <div class="video-frame">

                <iframe
                    src="${escapeHtml(videoUrl)}"
                    title="${escapeHtml(block.title || "Video pembelajaran")}"
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>

            </div>

            ${block.caption
      ? `
                    <p class="video-caption">
                        ${escapeHtml(block.caption)}
                    </p>
                `
      : ""}

        </section>
    `;
}


/* =========================================================
   TABEL
   ========================================================= */

function renderTableBlock(block) {
  if (!block.headers || !block.rows) return "";

  return `
        <div class="lesson-table-wrapper">

            <table class="lesson-table">

                <thead>
                    <tr>
                        ${block.headers.map(header => `
                            <th>${escapeHtml(header)}</th>
                        `).join("")}
                    </tr>
                </thead>

                <tbody>
                    ${block.rows.map(row => `
                        <tr>
                            ${row.map(cell => `
                                <td>${escapeHtml(cell)}</td>
                            `).join("")}
                        </tr>
                    `).join("")}
                </tbody>

            </table>

        </div>
    `;
}


/* =========================================================
   DIAGRAM
   ========================================================= */

function renderDiagramBlock(block) {
  if (!block.items) return "";

  return `
        <div class="lesson-diagram">

            ${block.items.map((item, index) => `
                <div class="diagram-item">

                    <span class="diagram-number">
                        ${index + 1}
                    </span>

                    <span>
                        ${escapeHtml(item)}
                    </span>

                </div>
            `).join("")}

        </div>
    `;
}


/* =========================================================
   TOMBOL UNDUH PDF
   ========================================================= */

function bindDownloadButton() {
  const button = document.getElementById("downloadLessonBtn");

  if (!button) return;

  button.addEventListener("click", downloadLessonPDF);
}


/* =========================================================
   LATIHAN - SATU SOAL PER HALAMAN
   ========================================================= */

function renderExercises(topic) {
  const questions = topic.exercises || [];

  if (questions.length === 0) {
    return `
            <p class="exercise-empty">
                Latihan untuk materi ini belum tersedia.
            </p>
        `;
  }

  const currentQuestion = questions[TUT_QUESTION_INDEX];
  const selectedAnswer = TUT_ANSWERS[TUT_QUESTION_INDEX];

  const answeredCount = Object.keys(TUT_ANSWERS).length;

  const allAnswered = answeredCount === questions.length;

  const isLastQuestion =
    TUT_QUESTION_INDEX === questions.length - 1;

  return `
        <div class="exercise-instruction">
            Pilih satu jawaban yang menurutmu paling tepat.
        </div>


        <div class="exercise-single-question">

            <div class="question-number">
                SOAL ${TUT_QUESTION_INDEX + 1} DARI ${questions.length}
            </div>

            <div class="exercise-progress-bar">
                <div style="width:${((TUT_QUESTION_INDEX + 1) / questions.length) * 100}%"></div>
            </div>


            <article class="exercise-question">

                <h3>
                    ${escapeHtml(currentQuestion.question)}
                </h3>

                <div class="exercise-options">

                    ${(currentQuestion.options || []).map((option, optionIndex) => `
                        <button
                            type="button"
                            class="exercise-option ${selectedAnswer === optionIndex ? "selected" : ""}"
                            data-option="${optionIndex}"
                            ${TUT_SUBMITTED ? "disabled" : ""}>

                            <span class="option-letter">
                                ${String.fromCharCode(65 + optionIndex)}
                            </span>

                            <span class="option-text">
                                ${escapeHtml(option)}
                            </span>

                        </button>
                    `).join("")}

                </div>

            </article>


            ${TUT_SUBMITTED
      ? renderQuestionFeedback(currentQuestion)
      : ""}

        </div>


        <div class="exercise-footer">

            <div class="exercise-progress">
                <span id="answeredCount">${answeredCount}</span>
                dari ${questions.length} soal dijawab
            </div>


            <div class="exercise-navigation">

                <button
                    type="button"
                    class="exercise-page-button"
                    id="prevQuestionBtn"
                    ${TUT_QUESTION_INDEX === 0 ? "disabled" : ""}>

                    <i class="fa-solid fa-arrow-left"></i>
                    Sebelumnya

                </button>


                ${!isLastQuestion ? `
                    <button
                        type="button"
                        class="exercise-page-button"
                        id="nextQuestionBtn">

                        Berikutnya
                        <i class="fa-solid fa-arrow-right"></i>

                    </button>
                ` : ""}


                ${isLastQuestion && allAnswered && !TUT_SUBMITTED ? `
                    <button
                        type="button"
                        class="exercise-check-button"
                        id="checkExerciseBtn">

                        <i class="fa-solid fa-check"></i>
                        Periksa Jawaban

                    </button>
                ` : ""}

            </div>

        </div>


        <div id="exerciseResult" aria-live="polite">

            ${TUT_SUBMITTED
      ? renderExerciseResult(topic)
      : ""}

        </div>
    `;
}


/* =========================================================
   FEEDBACK PER SOAL
   ========================================================= */

function renderQuestionFeedback(question) {
  const selectedAnswer = TUT_ANSWERS[TUT_QUESTION_INDEX];
  const correctAnswer = Number(question.answer);

  const isCorrect = selectedAnswer === correctAnswer;

  return `
        <div class="question-feedback">

            <div class="${isCorrect ? "feedback-correct" : "feedback-wrong"}">

                <strong>
                    ${isCorrect
      ? "✓ Jawaban benar!"
      : "✕ Jawaban belum tepat."}
                </strong>

                <p>
                    ${escapeHtml(question.explanation || "")}
                </p>

            </div>

        </div>
    `;
}


/* =========================================================
   EVENT LATIHAN
   ========================================================= */

function bindExerciseEvents(topic) {
  const container = document.getElementById("lessonExercise");

  if (!container) return;

  const questions = topic.exercises || [];

  const optionButtons = container.querySelectorAll(".exercise-option");

  optionButtons.forEach(button => {
    button.addEventListener("click", () => {
      if (TUT_SUBMITTED) return;

      const optionIndex = Number(button.dataset.option);

      TUT_ANSWERS[TUT_QUESTION_INDEX] = optionIndex;

      renderExerciseOnly(topic);
    });
  });


  const previousButton = document.getElementById("prevQuestionBtn");
  const nextButton = document.getElementById("nextQuestionBtn");
  const checkButton = document.getElementById("checkExerciseBtn");


  if (previousButton) {
    previousButton.addEventListener("click", () => {
      if (TUT_QUESTION_INDEX > 0) {
        TUT_QUESTION_INDEX--;

        renderExerciseOnly(topic);
      }
    });
  }


  if (nextButton) {
    nextButton.addEventListener("click", () => {
      if (TUT_QUESTION_INDEX < questions.length - 1) {
        TUT_QUESTION_INDEX++;

        renderExerciseOnly(topic);
      }
    });
  }


  if (checkButton) {
    checkButton.addEventListener("click", () => {
      checkExercise(topic);
    });
  }


  const retryButton = document.getElementById("retryExerciseBtn");

  if (retryButton) {
    retryButton.addEventListener("click", () => {
      TUT_ANSWERS = {};
      TUT_QUESTION_INDEX = 0;
      TUT_SUBMITTED = false;

      renderExerciseOnly(topic);
    });
  }
}


/* =========================================================
   RENDER ULANG LATIHAN SAJA
   ========================================================= */

function renderExerciseOnly(topic) {
  const container = document.getElementById("lessonExercise");

  if (!container) return;

  container.innerHTML = `
        <div class="exercise-heading">

            <span class="exercise-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </span>

            <div>
                <h2>Yuk, Berlatih!</h2>

                <p>
                    Kerjakan soal berikut untuk menguji
                    pemahamanmu tentang materi ini.
                </p>
            </div>

        </div>

        ${renderExercises(topic)}
    `;

  bindExerciseEvents(topic);
}


/* =========================================================
   PERIKSA JAWABAN
   ========================================================= */

function checkExercise(topic) {
  const questions = topic.exercises || [];

  const answeredCount = Object.keys(TUT_ANSWERS).length;

  if (answeredCount !== questions.length) {
    showToast("Jawab semua soal terlebih dahulu, ya!");
    return;
  }

  if (TUT_SUBMITTED) return;

  TUT_SUBMITTED = true;

  let correctCount = 0;

  questions.forEach((question, index) => {
    if (TUT_ANSWERS[index] === Number(question.answer)) {
      correctCount++;
    }
  });

  const total = questions.length;

  ProgressStore.recordQuizScore(
    topic.id,
    correctCount,
    total
  );

  if (correctCount === total) {
    ProgressStore.markTopicComplete(topic.id);
  }

  renderSidebar();

  renderExerciseOnly(topic);

  if (correctCount === total) {
    const meta = document.querySelector(".lesson-meta");

    if (meta && !meta.querySelector(".lesson-completed")) {
      const status = document.createElement("span");

      status.className = "lesson-completed";
      status.textContent = "✓ Sudah dipelajari";

      const downloadButton = document.getElementById("downloadLessonBtn");

      if (downloadButton) {
        meta.insertBefore(status, downloadButton);
      } else {
        meta.appendChild(status);
      }
    }
  }

  const result = document.getElementById("exerciseResult");

  if (result) {
    result.scrollIntoView({
      behavior: "smooth",
      block: "nearest"
    });
  }
}


/* =========================================================
   HASIL LATIHAN
   ========================================================= */

function renderExerciseResult(topic) {
  if (!TUT_SUBMITTED) return "";

  const questions = topic.exercises || [];

  let correctCount = 0;

  questions.forEach((question, index) => {
    if (TUT_ANSWERS[index] === Number(question.answer)) {
      correctCount++;
    }
  });

  const total = questions.length;

  const percentage = total > 0
    ? Math.round((correctCount / total) * 100)
    : 0;

  let message = "";

  if (percentage === 100) {
    message = "Hebat! Semua jawabanmu benar. Pertahankan!";
  } else if (percentage >= 75) {
    message = "Bagus! Kamu sudah memahami sebagian besar materi.";
  } else if (percentage >= 50) {
    message = "Cukup baik! Yuk, pelajari kembali bagian yang belum dipahami.";
  } else {
    message = "Jangan menyerah! Baca kembali materinya dan terus berlatih.";
  }

  return `
        <div class="exercise-result-card">

            <div class="result-score">
                <span>${percentage}%</span>
                <small>Nilai latihan</small>
            </div>

            <div class="result-detail">

                <h3>
                    ${correctCount} dari ${total} jawaban benar
                </h3>

                <p>${message}</p>

                ${correctCount === total
      ? `
                        <span class="result-completed">
                            ✓ Selesai Dipelajari
                        </span>
                    `
      : `
                        <span class="result-not-completed">
                            Pelajari kembali materi dan coba lagi.
                        </span>
                    `}

            </div>

        </div>


        <button
            type="button"
            class="exercise-retry-button"
            id="retryExerciseBtn">

            <i class="fa-solid fa-rotate-right"></i>
            Coba Lagi

        </button>
    `;
}


/* =========================================================
   NAVIGASI MATERI
   ========================================================= */

function bindLessonNavigation(previous, next) {
  const previousButton = document.getElementById("prevTopicBtn");
  const nextButton = document.getElementById("nextTopicBtn");

  if (previousButton && previous) {
    previousButton.addEventListener("click", () => {
      openTopic(previous.id);
    });
  }

  if (nextButton && next) {
    nextButton.addEventListener("click", () => {
      openTopic(next.id);
    });
  }
}


/* =========================================================
   STYLES
   ========================================================= */

function addTutorialStyles() {
  if (document.getElementById("wetlandTutorialStyles")) return;

  const style = document.createElement("style");

  style.id = "wetlandTutorialStyles";

  style.textContent = `

        .wetland-lesson {
            max-width: 100%;
            color: #26382f;
            font-family: 'Manrope', sans-serif;
        }

        .lesson-header {
            margin-bottom: 26px;
        }

        .lesson-kicker {
            color: #64836b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .lesson-kicker span {
            padding: 0 5px;
        }

        .lesson-header h1 {
            color: #284b3b;
            font-size: clamp(25px, 3vw, 34px);
            font-weight: 800;
            line-height: 1.3;
            margin: 0 0 10px;
        }

        .lesson-summary {
            color: #65756a;
            font-size: 15px;
            line-height: 1.7;
            margin: 0;
        }

        .lesson-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px 17px;
            margin-top: 15px;
            color: #718078;
            font-size: 12px;
        }

        .lesson-meta i {
            margin-right: 5px;
        }

        .lesson-completed {
            color: #34794c;
            font-weight: 800;
        }

        .lesson-download {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border: 1px solid #d5e2d2;
            border-radius: 7px;
            background: #f3f7f0;
            color: #315e3c;
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .lesson-download:hover {
            background: #e7efe2;
            border-color: #9db69a;
        }

        .learning-objectives {
            margin: 25px 0 30px;
            border: 1px solid #d9e4d7;
            border-radius: 9px;
            overflow: hidden;
            background: #fff;
        }

        .objectives-title {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 13px 17px;
            background: #edf3e9;
            color: #284b3b;
            border-bottom: 1px solid #d9e4d7;
            font-size: 14px;
        }

        .objectives-content {
            padding: 15px 20px;
        }

        .objectives-content p {
            margin: 0 0 9px;
            font-size: 13px;
            line-height: 1.7;
        }

        .objectives-content ul {
            margin: 0;
            padding-left: 22px;
        }

        .objectives-content li {
            margin-bottom: 7px;
            font-size: 13px;
            line-height: 1.65;
        }

        .lesson-material {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .lesson-section {
            margin: 0;
        }

        .lesson-section h2 {
            color: #284b3b;
            font-size: 20px;
            font-weight: 800;
            line-height: 1.4;
            margin: 0 0 12px;
        }

        .lesson-text {
            color: #3d4c43;
            font-size: 14px;
            line-height: 1.9;
        }

        .lesson-text p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0 0 13px;
        }

        .lesson-list {
            padding-left: 23px;
            margin: 10px 0 16px;
        }

        .lesson-list li {
            padding-left: 4px;
            margin-bottom: 8px;
            line-height: 1.8;
            text-align: justify;
        }

        .lesson-figure {
            width: 100%;
            max-width: 570px;
            margin: 5px auto 12px;
            text-align: center;
        }

        .lesson-figure img {
            display: block;
            width: 100%;
            max-height: 285px;
            object-fit: cover;
            border-radius: 9px;
            background: #edf2eb;
        }

        .lesson-figure figcaption {
            color: #718078;
            font-size: 12px;
            line-height: 1.6;
            padding: 9px 12px 0;
        }

        .image-source {
            display: block;
            margin-top: 3px;
            font-size: 10px;
            color: #87948a;
        }

        .image-fallback {
            display: none;
            padding: 24px;
            color: #718078;
            background: #f1f4ef;
            border-radius: 8px;
            font-size: 13px;
        }

        .image-error .image-fallback {
            display: block;
        }

        .lesson-callout {
            display: flex;
            gap: 14px;
            padding: 17px 19px;
            margin: 8px 0 16px;
            background: #f0f5eb;
            border-left: 4px solid #71966e;
            border-radius: 7px;
        }

        .callout-icon {
            color: #64875f;
            font-size: 20px;
            padding-top: 2px;
        }

        .callout-content h3 {
            color: #345b3e;
            font-size: 15px;
            font-weight: 800;
            margin: 0 0 6px;
        }

        .callout-content p {
            color: #536457;
            font-size: 13px;
            line-height: 1.8;
            margin: 0;
            text-align: justify;
        }

        .lesson-video {
            margin: 12px 0 20px;
        }

        .lesson-video h2 {
            font-size: 19px;
            color: #284b3b;
            margin-bottom: 12px;
        }

        .video-frame {
            width: 100%;
            max-width: 650px;
            margin: auto;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            border-radius: 10px;
            background: #172b28;
        }

        .video-frame iframe {
            display: block;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-caption {
            text-align: center;
            color: #718078;
            font-size: 12px;
            margin-top: 8px;
        }

        .lesson-table-wrapper {
            overflow-x: auto;
            margin: 12px 0 20px;
        }

        .lesson-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .lesson-table th,
        .lesson-table td {
            padding: 11px 13px;
            border: 1px solid #dce5d8;
            text-align: left;
        }

        .lesson-table th {
            background: #edf3e9;
            color: #284b3b;
        }

        .lesson-table td {
            line-height: 1.65;
        }

        .lesson-diagram {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 20px 0;
        }

        .diagram-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px 16px;
            border: 1px solid #dce5d8;
            border-radius: 8px;
            background: #f7f9f4;
            color: #345b3e;
            font-size: 13px;
            font-weight: 700;
        }

        .diagram-number {
            display: grid;
            place-items: center;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #dfeadd;
        }

        .lesson-exercise {
            margin-top: 38px;
            padding: 22px;
            background: #fff;
            border: 1px solid #dce5d8;
            border-radius: 11px;
        }

        .exercise-heading {
            display: flex;
            gap: 13px;
            align-items: center;
            margin-bottom: 17px;
        }

        .exercise-icon {
            display: grid;
            place-items: center;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #e7efe2;
            color: #426c4a;
            font-size: 18px;
        }

        .exercise-heading h2 {
            color: #284b3b;
            font-size: 20px;
            font-weight: 800;
            margin: 0 0 4px;
        }

        .exercise-heading p {
            color: #718078;
            font-size: 12px;
            margin: 0;
            line-height: 1.6;
        }

        .exercise-instruction {
            padding: 12px 14px;
            margin-bottom: 18px;
            border-radius: 7px;
            background: #f3f6f0;
            color: #536457;
            font-size: 13px;
            line-height: 1.6;
        }

        .exercise-single-question {
            min-height: 230px;
        }

        .exercise-progress-bar {
            width: 100%;
            height: 6px;
            margin: 10px 0 20px;
            overflow: hidden;
            border-radius: 20px;
            background: #e9eee6;
        }

        .exercise-progress-bar div {
            height: 100%;
            border-radius: 20px;
            background: #6f966d;
            transition: width .25s ease;
        }

        .exercise-question {
            padding: 10px 0 18px;
        }

        .question-number {
            color: #73916f;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            margin-bottom: 8px;
        }

        .exercise-question h3 {
            color: #304237;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.7;
            margin: 0 0 17px;
        }

        .exercise-options {
            display: grid;
            gap: 9px;
        }

        .exercise-option {
            display: flex;
            align-items: center;
            gap: 11px;
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dce5d8;
            border-radius: 7px;
            background: #fff;
            color: #435248;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.55;
            text-align: left;
            cursor: pointer;
            transition: .2s;
        }

        .exercise-option:hover:not(:disabled) {
            border-color: #799b76;
            background: #f5f8f2;
        }

        .exercise-option.selected {
            border-color: #628765;
            background: #edf4e9;
        }

        .option-letter {
            display: grid;
            place-items: center;
            width: 27px;
            height: 27px;
            flex-shrink: 0;
            border-radius: 6px;
            background: #edf2e9;
            color: #47664b;
            font-weight: 800;
            font-size: 11px;
        }

        .exercise-option.correct {
            border-color: #4d9361;
            background: #edf7ef;
            color: #28603b;
        }

        .exercise-option.correct .option-letter {
            background: #d7eadb;
            color: #28603b;
        }

        .exercise-option.wrong {
            border-color: #d47a72;
            background: #fff1ef;
            color: #963d37;
        }

        .exercise-option:disabled {
            cursor: default;
            opacity: 1;
        }

        .question-feedback {
            margin-top: 12px;
        }

        .feedback-correct,
        .feedback-wrong {
            padding: 11px 13px;
            border-radius: 7px;
            font-size: 12px;
            line-height: 1.7;
        }

        .feedback-correct {
            background: #edf7ef;
            color: #28603b;
        }

        .feedback-wrong {
            background: #fff2ef;
            color: #963d37;
        }

        .question-feedback p {
            margin: 4px 0 0;
        }

        .exercise-footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-top: 18px;
            border-top: 1px solid #e8eee5;
        }

        .exercise-progress {
            color: #718078;
            font-size: 12px;
        }

        .exercise-navigation {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 8px;
        }

        .exercise-page-button,
        .exercise-check-button,
        .exercise-retry-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid #dce5d8;
            border-radius: 7px;
            background: #fff;
            color: #365f43;
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .exercise-page-button:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .exercise-page-button:hover:not(:disabled) {
            background: #f2f6ef;
        }

        .exercise-check-button {
            border-color: #365f43;
            background: #365f43;
            color: #fff;
        }

        .exercise-check-button:hover {
            background: #284b3b;
        }

        .exercise-result-card {
            display: flex;
            align-items: center;
            gap: 17px;
            margin-top: 20px;
            padding: 18px;
            border-radius: 9px;
            background: #f1f6ed;
        }

        .result-score {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 85px;
            height: 85px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #dcebd8;
            color: #315e3c;
        }

        .result-score span {
            font-size: 23px;
            font-weight: 900;
        }

        .result-score small {
            font-size: 10px;
        }

        .result-detail h3 {
            color: #315e3c;
            font-size: 15px;
            font-weight: 800;
            margin: 0 0 5px;
        }

        .result-detail p {
            color: #5e7061;
            font-size: 12px;
            line-height: 1.6;
            margin: 0 0 6px;
        }

        .result-completed,
        .result-not-completed {
            font-size: 11px;
            font-weight: 700;
        }

        .result-completed {
            color: #34794c;
        }

        .result-not-completed {
            color: #8a7145;
        }

        .exercise-retry-button {
            margin-top: 13px;
            background: #e8efe4;
            color: #365f43;
        }

        .exercise-empty {
            color: #718078;
            font-size: 13px;
        }

        .lesson-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 35px;
            padding-top: 22px;
            border-top: 1px solid #dce5d8;
        }

        .lesson-navigation-prev,
        .lesson-navigation-next {
            max-width: 48%;
        }

        .lesson-navigation-next {
            margin-left: auto;
        }

        .lesson-nav-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border: 1px solid #dce5d8;
            border-radius: 8px;
            background: #fff;
            color: #345b3e;
            text-decoration: none;
            cursor: pointer;
            text-align: left;
            font-family: inherit;
        }

        .lesson-nav-button.next {
            text-align: right;
            background: #edf3e9;
        }

        .lesson-nav-button small,
        .lesson-nav-button strong {
            display: block;
        }

        .lesson-nav-button small {
            color: #849187;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .lesson-nav-button strong {
            color: #345b3e;
            font-size: 12px;
        }

        .tut-error {
            padding: 25px;
            border-radius: 9px;
            background: #fff1ef;
            color: #963d37;
        }

        .wetland-toast {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 9999;
            padding: 12px 18px;
            border-radius: 8px;
            background: #284b3b;
            color: #fff;
            font-size: 13px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: .25s;
        }

        .wetland-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 650px) {

            .lesson-header h1 {
                font-size: 25px;
            }

            .lesson-section h2 {
                font-size: 18px;
            }

            .lesson-figure {
                max-width: 100%;
            }

            .lesson-figure img {
                max-height: 220px;
            }

            .lesson-exercise {
                padding: 15px;
            }

            .exercise-result-card {
                align-items: flex-start;
            }

            .result-score {
                width: 70px;
                height: 70px;
            }

            .lesson-navigation {
                align-items: stretch;
            }

            .lesson-navigation-prev,
            .lesson-navigation-next {
                max-width: 50%;
            }

            .lesson-nav-button {
                padding: 9px;
            }

            .lesson-nav-button strong {
                font-size: 10px;
            }

            .lesson-meta {
                gap: 9px;
            }

            .exercise-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .exercise-navigation {
                width: 100%;
            }
        }

        @media print {

            @page {
                size: A4;
                margin: 18mm;
            }

            body * {
                visibility: hidden !important;
            }

            #tutContentBody,
            #tutContentBody * {
                visibility: visible !important;
            }

            #tutContentBody {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .wetland-lesson {
                width: 100% !important;
                max-width: none !important;
                color: #202b25 !important;
                font-family: 'Manrope', sans-serif !important;
            }

            .no-print,
            .lesson-exercise,
            .lesson-navigation,
            .wetland-toast,
            .site-header,
            .tut-sidebar {
                display: none !important;
            }

            .lesson-header h1 {
                font-size: 24px !important;
            }

            .lesson-section,
            .lesson-callout,
            .lesson-figure,
            .lesson-video {
                break-inside: avoid;
            }

            .lesson-text p {
                text-align: justify;
            }

            .lesson-figure {
                max-width: 450px;
            }

            .lesson-figure img {
                max-height: 240px;
                object-fit: contain;
            }

            .video-frame {
                display: none !important;
            }

            .lesson-video::after {
                content: "Video pembelajaran tersedia pada halaman website.";
                display: block;
                font-size: 11px;
                color: #718078;
            }
        }
    `;

  document.head.appendChild(style);
}


/* =========================================================
   START
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {
  addTutorialStyles();
  initTutorialPage();
});
