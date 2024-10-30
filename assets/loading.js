window.addEventListener('load', function () {
    setTimeout(function () {
        // ซ่อนหน้า loading
        document.getElementById('loading').style.display = 'none';
        // แสดงเนื้อหาและทำให้การเปลี่ยนแปลงเนียนขึ้น
        const content = document.getElementById('content');
        content.classList.add('show'); // เพิ่มคลาส 'show' เพื่อให้เกิดการเปลี่ยนแปลง
    }, 500); // 1000 มิลลิวินาที = 1 วินาที
});