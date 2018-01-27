const days = document.querySelectorAll(`.day`);
const tags = document.querySelectorAll(`.tag`);
const input = document.querySelector(`.input`);
let selectedDaysDates;
let selectedTagNames;
let selectedDays = [];
let selectedTags = [];

const init = () => {
  days.forEach(day => day.addEventListener(`click`, dayClick));
  updateSelectedDays();

  tags.forEach(tag => tag.addEventListener(`click`, tagClick));
  updateSelectedTags();

  input.addEventListener(`input`, inputInput);
};

const inputInput = () => {
  sendToPhp();
};

const dayClick = e => {
  toggleClass(e, `day-inactive`);
  updateSelectedDays();
  sendToPhp();
};

const tagClick = e => {
  toggleClass(e, `tag-inactive`);
  updateSelectedTags();
  sendToPhp();
};

const toggleClass = (e, klasse) => {
  if( e.currentTarget.classList.contains(klasse)) {
    e.currentTarget.classList.remove(klasse);
  } else {
    e.currentTarget.classList.add(klasse);
  }
};

const updateSelectedDays = () => {
  selectedDays = Array.from(days);
  selectedDays = selectedDays.filter(day => !day.classList.contains(`day-inactive`));
  selectedDaysDates = [];
  selectedDays.forEach(day => selectedDaysDates.push(day.dataset.day));
  console.log(selectedDaysDates);
  sendToPhp();
};

const updateSelectedTags = () => {
  selectedTags = Array.from(tags);
  selectedTags = selectedTags.filter(tag => !tag.classList.contains(`tag-inactive`));
  selectedTagNames = [];
  selectedTags.forEach(tag => selectedTagNames.push(tag.innerText));
  console.log(selectedTagNames);
};

const sendToPhp = () => {

  const $form = new FormData();
  $form.append(`action`, `search`);
  $form.append(`days`, selectedDays);

  fetch(`index.php`, {
    headers: new Headers({
      Accept: `application/json`,
    }),
    method: `post`,
    body: $form,
  });
};

init();
