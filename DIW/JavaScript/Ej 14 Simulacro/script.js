"use strict";

const DAYS = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
const START_HOUR = 8;
const END_HOUR = 22;

const weekGrid = document.getElementById("weekGrid");

function pad2(n){ return String(n).padStart(2,"0"); }
function timeLabel(h,m){ return `${pad2(h)}:${pad2(m)}`; }
function buildSlots(){
  const slots = [];
  for(let h=START_HOUR; h<END_HOUR; h++){
    slots.push({hh:h, mm:0});
    slots.push({hh:h, mm:30});
  }
  return slots;
}

function cellHasEvent(cell){
  return cell.dataset.hasEvent === "1";
}

function clearCellEvent(cell){
  cell.innerHTML = "";
  cell.dataset.hasEvent = "0";
  cell.dataset.title = "";
}

function renderEventInCell(cell, title){
  cell.innerHTML = "";

  const span = document.createElement("span");
  span.className = "event";
  span.textContent = title;
  span.title = "Doble click para renombrar";

  const del = document.createElement("button");
  del.className = "deleteBtn";
  del.type = "button";
  del.textContent = "×";
  del.title = "Borrar cita";

  del.addEventListener("click", (e)=>{
    e.stopPropagation();
    clearCellEvent(cell);
  });

  cell.appendChild(span);
  cell.appendChild(del);

  cell.dataset.hasEvent = "1";
  cell.dataset.title = title;
}

/* Construir calendario */
function buildWeekGrid(){
  weekGrid.innerHTML = "";

  // header
  const corner = document.createElement("div");
  corner.className = "cell header corner";
  corner.textContent = "Hora";
  weekGrid.appendChild(corner);

  for(let d=0; d<DAYS.length; d++){
    const hd = document.createElement("div");
    hd.className = "cell header";
    hd.textContent = DAYS[d];
    weekGrid.appendChild(hd);
  }

  const slots = buildSlots();

  for(const slot of slots){
    const timeCell = document.createElement("div");
    timeCell.className = "cell time";
    timeCell.textContent = timeLabel(slot.hh, slot.mm);
    weekGrid.appendChild(timeCell);

    for(let d=0; d<DAYS.length; d++){
      const cell = document.createElement("div");
      cell.className = "cell slot";
      cell.tabIndex = 0;

      cell.dataset.hasEvent = "0";
      cell.dataset.title = "";

      cell.addEventListener("click", ()=>{
        if(cellHasEvent(cell)) return;
        const title = "Cita";
        renderEventInCell(cell, title);
      });

      weekGrid.appendChild(cell);
    }
  }
}

/* IMC */
const bmiForm = document.getElementById("bmiForm");
const pesoInput = document.getElementById("peso");
const alturaInput = document.getElementById("altura");
const bmiValue = document.getElementById("bmiValue");
const bmiStatus = document.getElementById("bmiStatus");

bmiForm.addEventListener("submit", (e)=>{
  e.preventDefault();

  const peso = Number(pesoInput.value);
  const alturaCm = Number(alturaInput.value);
  if(!peso || !alturaCm) return;

  const alturaM = alturaCm / 100;
  const imc = peso / (alturaM * alturaM);

  bmiValue.textContent = imc.toFixed(2);

  let estado = "—";
  if(imc < 18.5) estado = "Bajo peso";
  else if(imc < 25) estado = "Normal";
  else if(imc < 30) estado = "Sobrepeso";
  else estado = "Obesidad";

  bmiStatus.textContent = estado;
});

buildWeekGrid();
