const days = document.querySelectorAll('.day');
let selectedDays = [];

const init = () => {
  days.forEach(day => day.addEventListener(`click`, dayClick));
  updateSelectedDays();
}

const dayClick = e => {
  if( e.currentTarget.classList.contains('day-inactive')) {
    e.currentTarget.classList.remove('day-inactive');
  } else {
    e.currentTarget.classList.add('day-inactive');
  }
  updateSelectedDays();
}

const updateSelectedDays = () => {
  selectedDays = Array.from(days);
  selectedDays = selectedDays.filter(day => !day.classList.contains('day-inactive'));
  const selectedDaysDates = [];
  selectedDays.forEach(day => selectedDaysDates.push(day.dataset.day));
  console.log(selectedDaysDates);
}

init();
