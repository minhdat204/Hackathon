
//duyệt tất cả các child của process-step
document.querySelectorAll(".process-step").forEach((header) => {
    //nếu click vào process-step
    header.addEventListener("click", () => {
        //lấy element của step-description và toggle-btn trong header đang duyệt
        const description = header.querySelector(".step-description");
        const toggleBtn = header.querySelector(".toggle-btn");

        //nếu trong description có style display là none (bị ẩn đi)
        if (
            description.style.display === "none" ||
            description.style.display === ""
        ) {
            //thì đặt display là block và add class acctive-step vào header (cha)
            //và đổi dấu cộng trong toggleBtn thành trừ
            description.style.display = "block";
            header.classList.add("active-step");
            toggleBtn.textContent = "-";
            //ngược lại
        } else {
            description.style.display = "none";
            header.classList.remove("active-step");
            toggleBtn.textContent = "+";
        }
    });
});
