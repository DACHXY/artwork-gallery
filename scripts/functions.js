function handleInputChange(id) {
    var input = document.getElementById(id);
    var label = input.nextElementSibling; // 下一個兄弟元素就是 label 元素
    if (input.value !== '') {
        label.classList.add('focused');
    } else {
        label.classList.remove('focused');
    }
}

function makeEditable(element) {
    element.contentEditable = true;
    element.focus();
}

function checkValue(element) {
    var value = parseInt(element.innerText);
    if (value === 0) {
      element.innerText = element.dataset.previousValue || '';
    } else {
      element.dataset.previousValue = value;
    }
  }