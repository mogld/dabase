function showAddForm() {
      var form = document.getElementById("add-form");
      form.style.display = "block";
}

var addFormVisible = false;

function toggleAddForm() {
  var addForm = document.getElementById('add-form');
  if (!addFormVisible) {
      addForm.style.display = "block";
      addFormVisible = true;
  } else {
      addForm.style.display = "none";
      addFormVisible = false;
  }
}

function MiniCalendar() {
  var container = document.getElementById('mini_calender');
  var monthYearLabel = container.querySelector('.month-year');
  var prevMonthBtn = container.querySelector('#prev-month-btn');
  var nextMonthBtn = container.querySelector('#next-month-btn');
  var calendarBody = container.querySelector('.calendar-body tbody');

  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  var currentMonth = currentDate.getMonth();

  var months = [
    '1월', '2월', '3월', '4월', '5월', '6월',
    '7월', '8월', '9월', '10월', '11월', '12월'
  ];
  
function updateCalendar() {
  var firstDay = new Date(currentYear, currentMonth, 1);
  var lastDay = new Date(currentYear, currentMonth + 1, 0);
  var startDate = new Date(firstDay);
  startDate.setDate(startDate.getDate() - firstDay.getDay());
  var endDate = new Date(lastDay);
  endDate.setDate(endDate.getDate() + (6 - lastDay.getDay()));

  monthYearLabel.textContent = months[currentMonth] + ' ' + currentYear;

  calendarBody.innerHTML = '';

  var date = new Date(startDate);
    while (date <= endDate) {
    var row = document.createElement('tr');
    for (var i = 0; i < 7; i++) {
        var cell = document.createElement('td');
        cell.textContent = date.getDate();
        if (date.getMonth() !== currentMonth) {
        cell.classList.add('disabled');
        } else {
        cell.addEventListener('click', selectDate);
        }
        if (date.toDateString() === currentDate.toDateString()) {
        cell.classList.add('today');
        }
        row.appendChild(cell);
        date.setDate(date.getDate() + 1);
    }
    calendarBody.appendChild(row);
    }
}

function selectDate() {
    var selectedCell = container.querySelector('.calendar-body td.selected');
    if (selectedCell) {
      selectedCell.classList.remove('selected');
    }
    this.classList.add('selected');
}
  
prevMonthBtn.addEventListener('click', function () {
    currentMonth--;
    if (currentMonth < 0) {
      currentYear--;
      currentMonth = 11;
    }
    updateCalendar();
});

nextMonthBtn.addEventListener('click', function () {
    currentMonth++;
    if (currentMonth > 11) {
      currentYear++;
      currentMonth = 0;
    }
    updateCalendar();
});

updateCalendar();
}

MiniCalendar();