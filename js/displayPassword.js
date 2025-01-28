function toggleVisibility(inputId, imgId) {
    const input = document.getElementById(inputId);
    const img = document.getElementById(imgId);

    if (input.type === "password") {
        input.type = "text";
        img.src = "../img/eye_open.png";
    } else {
        input.type = "password";
        img.src = "../img/eye_close.png";
    }
}
