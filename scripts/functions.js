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


function updateImagePreview(event, id) {
  var input = event.target;
  var img = document.getElementById(id);

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      img.src = e.target.result;
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function Click(id) {
  var element = document.getElementById(id);
  element.click();
}