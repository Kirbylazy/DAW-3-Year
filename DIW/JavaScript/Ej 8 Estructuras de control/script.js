'use strict';

// Helpers
const $ = (sel) => document.querySelector(sel);

function setAlert(targetSel, type, title, bodyHtml = '') {
  const el = $(targetSel);
  el.innerHTML = `
    <div class="alert alert-${type} mt-2 mb-0" role="alert">
      <div class="fw-bold">${title}</div>
      ${bodyHtml ? `<div class="mt-2">${bodyHtml}</div>` : ''}
    </div>
  `;
}

function setCard(targetSel, title, bodyHtml) {
  const el = $(targetSel);
  el.innerHTML = `
    <div class="card border-info mt-2">
      <div class="card-header fw-semibold">${title}</div>
      <div class="card-body">
        ${bodyHtml}
      </div>
    </div>
  `;
}

function renderInlineList(items) {
  return `<div class="fs-5">${items.join(' · ')}</div>`;
}

function range(from, to, step = 1) {
  const out = [];
  if (step === 0) return out;
  const asc = from <= to;
  if (asc) {
    for (let i = from; i <= to; i += Math.abs(step)) out.push(i);
  } else {
    for (let i = from; i >= to; i -= Math.abs(step)) out.push(i);
  }
  return out;
}

function sumArray(arr) {
  let s = 0;
  for (const n of arr) s += n;
  return s;
}

// Clear buttons (data-clear)
document.addEventListener('click', (e) => {
  const btn = e.target.closest('[data-clear]');
  if (!btn) return;
  const target = btn.getAttribute('data-clear');
  const el = $(target);
  if (el) el.innerHTML = '';
});

// 1) Números del 1 al 10 (Si/No)
$('#btn1').addEventListener('click', () => {
  const yes = confirm('¿Deseas ver los números del 1 al 10 en pantalla?');
  if (yes) {
    const nums = range(1, 10, 1);
    setCard('#out1', 'Resultado', renderInlineList(nums));
  } else {
    setAlert('#out1', 'warning', 'Has llegado al final');
  }
});

// 2) Pares 1..20 + pregunta
$('#btn2').addEventListener('click', () => {
  const inp = $('#inp2');
  const val = Number(inp.value);

  // Total de pares entre 1 y 20: 2,4,6,...,20 => 10
  const correct = 10;

  if (!Number.isFinite(val)) {
    setAlert('#out2', 'danger', 'Introduce un número válido.');
    inp.focus();
    return;
  }

  if (val === correct) {
    const evens = [];
    for (let i = 2; i <= 20; i += 2) evens.push(i);
    setAlert('#out2', 'success', 'Correcto ✅', renderInlineList(evens));
  } else {
    // “Vuelve a intentarlo (y te devuelve a la pregunta origen)”
    setAlert('#out2', 'danger', 'Debes esforzarte más. Vuelve a intentarlo.');
    inp.value = '';
    inp.focus();
  }
});

// 3) Suma 1..100
$('#btn3').addEventListener('click', () => {
  // Fórmula: n(n+1)/2
  const n = 100;
  const total = (n * (n + 1)) / 2;
  setAlert('#out3', 'info', 'Suma total', `<span class="fs-4 fw-bold">${total}</span>`);
});

// 4) Tabla del 5
$('#btn4').addEventListener('click', () => {
  const lines = [];
  for (let i = 1; i <= 10; i++) {
    lines.push(`${5} × ${i} = ${5 * i}`);
  }

  const html = `
    <ul class="list-group">
      ${lines.map(l => `<li class="list-group-item d-flex justify-content-between">
        <span>${l.split('=')[0].trim()}</span>
        <span class="fw-bold">${l.split('=')[1].trim()}</span>
      </li>`).join('')}
    </ul>
  `;

  setCard('#out4', 'Tabla del 5', html);
});

// 5) Array frutas (4)
$('#btn5').addEventListener('click', () => {
  const frutas = ['Manzana', 'Plátano', 'Naranja', 'Fresa'];
  const html = `
    <div class="d-flex flex-wrap gap-2">
      ${frutas.map(f => `<span class="badge text-bg-primary p-2">${f}</span>`).join('')}
    </div>
  `;
  setCard('#out5', 'Frutas', html);
});

// 6) Suma pares 1..100
$('#btn6').addEventListener('click', () => {
  let sum = 0;
  for (let i = 2; i <= 100; i += 2) sum += i;
  setAlert('#out6', 'info', 'Suma de pares (1..100)', `<span class="fs-4 fw-bold">${sum}</span>`);
});

// 7) Descendente 10..1
$('#btn7').addEventListener('click', () => {
  const nums = range(10, 1, 1);
  setCard('#out7', 'Resultado', renderInlineList(nums));
});

// 8) Media array 10,20,30,40,50
$('#btn8').addEventListener('click', () => {
  const arr = [10, 20, 30, 40, 50];
  const media = sumArray(arr) / arr.length;

  const html = `
    <div class="mb-2">Array: <span class="badge text-bg-info">${arr.join(', ')}</span></div>
    <div>Media: <span class="fs-4 fw-bold">${media}</span></div>
  `;
  setAlert('#out8', 'success', 'Resultado', html);
});
