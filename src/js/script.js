const days = document.querySelectorAll(`.day`);
const tags = document.querySelectorAll(`.tag`);
const input = document.querySelector(`.input`);
let selectedDaysDates = [];
let selectedTagNames = [];
let selectedDays = [];
let selectedTags = [];

const init = () => {

  if (days.length > 0) {
    days.forEach(day => day.addEventListener(`click`, dayClick));
    updateSelectedDays();
  }

  if (tags.length > 0) {
    tags.forEach(tag => tag.addEventListener(`click`, tagClick));
    updateSelectedTags();
  }

  if (input != null) {
    input.addEventListener(`input`, inputInput);
  }
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
  sendToPhp();
};

const updateSelectedTags = () => {
  selectedTags = Array.from(tags);
  selectedTags = selectedTags.filter(tag => !tag.classList.contains(`tag-inactive`));
  selectedTagNames = [];
  selectedTags.forEach(tag => selectedTagNames.push(tag.innerText));
  sendToPhp();
};

const sendToPhp = () => {

  const $form = new FormData();
  $form.append(`action`, `search`);
  $form.append(`days`, selectedDaysDates.toString());
  $form.append(`tags`, selectedTagNames.toString());
  $form.append(`location`, input.value);

  fetch(`view/events/getJson.php`, {
    headers: new Headers({
      Accept: `application/json`,
    }),
    method: `post`,
    body: $form,
  })
    .then(r => r.json())
    .then(data => loadEvents(data));
};

const formatDate = dateTime => {
  const date = new Date(dateTime);
  return `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`;
};

const formatTime = (start, end) => {
  const startTime = new Date(start);
  const endTime = new Date(end);
  return `${addZero(startTime.getHours())}:${addZero(startTime.getMinutes())} - ${addZero(endTime.getHours())}:${addZero(endTime.getMinutes())}`;
};

const addZero = amount => {
  if (amount < 10) {
    amount = `0${amount}`;
  }

  return amount;
};

const formatInfo = content => {
  return `${content.replace(/<\/?[^>]+(>|$)/g, ``).substring(1, 140)}...`;
};

const loadEvents = events => {

  const $events = document.querySelector(`.events`);

  if ($events != null) {

    console.log(events.length);
    $events.innerHTML = ``;
    if (events.length === 0) {

      const $p = document.createElement(`p`);
      $p.innerText = `Geen events gevonden.`;
      $p.classList.add(`no-events-found`);

      $events.appendChild($p);
    }

    events.forEach(event => {
      const $article = document.createElement(`article`);
      $article.classList.add(`event-card`);

      const $thumb = document.createElement(`img`);
      $thumb.src = `assets/thumbnails/${event.code}.jpg`;
      $thumb.classList.add(`event-card-image`);

      const $title = document.createElement(`h3`);
      $title.innerText = event.title;

      const $dateTime = document.createElement(`div`);
      $dateTime.classList.add(`dateTime`);

      const $date = document.createElement(`p`);
      $date.classList.add(`date`);
      $date.innerText = formatDate(event.start);

      const $time = document.createElement(`p`);
      $time.classList.add(`time`);
      $time.innerText = formatTime(event.start, event.end);

      const $location = document.createElement(`p`);
      $location.classList.add(`location`);
      $location.innerText = event.location;

      const $info = document.createElement(`p`);
      $info.classList.add(`info`);
      $info.innerText = formatInfo(event.content);

      const $button = document.createElement(`a`);
      $button.href = `?page=detail&e=${event.id}`;
      $button.classList.add(`button`);
      $button.classList.add(`green-button`);
      $button.classList.add(`wide-button`);
      $button.innerText = `Lees Meer`;

      $dateTime.appendChild($date);
      $dateTime.appendChild($time);

      $article.appendChild($thumb);
      $article.appendChild($title);
      $article.appendChild($dateTime);
      $article.appendChild($location);
      $article.appendChild($info);
      $article.appendChild($button);

      $events.appendChild($article);
    });
  }

};

init();
