function handleInputChange(id) {
    var input = document.getElementById(id);
    var label = input.nextElementSibling; // 下一個兄弟元素就是 label 元素
    if (input.value !== '') {
        label.classList.add('focused');
    } else {
        label.classList.remove('focused');
    }
}