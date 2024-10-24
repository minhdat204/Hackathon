document.getElementById("button").addEventListener("change", function() {
    const label = document.querySelector("label.bevel");
    const span = document.getElementById("vote-status");

    if (this.checked) {
      label.innerHTML = "Cảm ơn bạn!";
      span.innerHTML = "Đã bình chọn";
    } else {
      label.innerHTML = "Bình chọn";
      span.innerHTML = "Bevel Up";
    }
  });
