const days = document.querySelectorAll('.day');
const tags = document.querySelectorAll('.tag');
let selectedDays = [];

const init = () => {
  days.forEach(day => day.addEventListener(`click`, dayClick));
  updateSelectedDays();

  tags.forEach(tag => tag.addEventListener(`click`, tagClick));
}

const dayClick = e => {
  toggleClass(e, 'day-inactive');
  updateSelectedDays();
}

const tagClick = e => {
  toggleClass(e, 'tag-inactive');
}

const toggleClass = (e, klasse) => {
  if( e.currentTarget.classList.contains(klasse)) {
    e.currentTarget.classList.remove(klasse);
  } else {
    e.currentTarget.classList.add(klasse);
  }
}

const updateSelectedDays = () => {
  selectedDays = Array.from(days);
  selectedDays = selectedDays.filter(day => !day.classList.contains('day-inactive'));
  const selectedDaysDates = [];
  selectedDays.forEach(day => selectedDaysDates.push(day.dataset.day));
  console.log(selectedDaysDates);
}

init();
