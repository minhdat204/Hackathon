document.getElementById('voteButton').addEventListener('click', function() {
    // Thay đổi nội dung nút thành "Đã bình chọn"
    this.textContent = "Đã bình chọn";
    this.disabled = true; // Tắt nút để tránh bình chọn lại

    // Dữ liệu cần gửi (ở đây bạn có thể gửi thêm thông tin khác như id người dùng)
    const data = {
        islike: 1
    };

    // Gửi yêu cầu đến server bằng Fetch API
    fetch('/vote', { // '/vote' là route xử lý yêu cầu trên server
        method: 'POST', // Phương thức POST
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token trong Laravel
        },
        body: JSON.stringify(data) // Gửi dữ liệu dưới dạng JSON
    })
    .then(response => response.json())
    .then(result => {
        document.querySelector('#followers').innerHTML=  result['count'];
    })
    .catch(error => {
        console.error('Error:', error); // Xử lý lỗi nếu có
    });
});
