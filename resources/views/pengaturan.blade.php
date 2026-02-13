<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengaturan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4eeee;padding:40px;}

/* HEADER */
.top-bar{display:flex;align-items:center;margin-bottom:30px;}
.header-left{min-width:180px;}
.header-left h2{font-size:26px;font-weight:600;color:#f37b7b;}

.search-box{position:relative;width:420px;margin-left:auto;margin-right:40px;}
.search-box input{
width:100%;height:38px;padding:0 18px 0 42px;
border:1.5px solid #f48a8a;border-radius:30px;
outline:none;font-size:14px;background:#fff;}
.search-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);
font-size:18px;color:#f37b7b;}

.right-menu{display:flex;align-items:center;gap:15px;}
.notif{font-size:20px;color:#f37b7b;cursor:pointer;}

.badge, .profile {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #fff;
    padding: 0 18px;
    height: 56px;
    border-radius: 16px;
    box-shadow: 0 10px 22px rgba(0,0,0,0.12);
    font-size: 14px;
    min-width: 160px; /* samakan lebar visual */
}

/* FLAG */
.badge img {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 3px 6px rgba(0,0,0,0.18);
}

/* TEKS ID BOLD */
.badge span {
    font-weight: 600;
}

/* AVATAR */
.avatar {
    width: 26px;
    height: 26px;
    background: #f37b7b;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-weight: 600;
    font-size: 13px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.18);
}

/* WRAPPER TEKS PROFILE */
.profile-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.1; /* ini kunci biar tinggi box sama */
}

.profile-text .name {
    font-weight: 600;
}

.profile-text .role {
    font-size: 12px;
    color: #999;
}

/* CHEVRON RATA KANAN */
.badge i,
.profile i {
    margin-left: auto;
    color: #f37b7b;
    font-size: 20px;
}


/* CARD */
.card{background:#fff;padding:35px;border-radius:20px;}
.card h3{margin-bottom:30px;font-weight:600;color:#333;}

/* FORM HORIZONTAL */
.form-group{display:flex;align-items:flex-start;gap:30px;margin-bottom:22px;}
.form-group label{
width:180px;font-size:14px;font-weight:600;color:#333;padding-top:10px;}

.form-control {
    flex: auto;
}


input,textarea,select{
width:100%;padding:10px 14px;border-radius:10px;
border:2px solid #f3a3a3;font-size:13px;outline:none;background:#fff;}

textarea{height:120px;resize:none;}

/* DROPDOWN TEMA */
.select-tema {
    width: 120px;
    padding: 10px 38px 10px 14px; /* ruang kanan untuk icon */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: #fff url("data:image/svg+xml;utf8,<svg fill='%23f37b7b' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 12px center;
    background-size: 18px;
}


/* LOGO */
.logo-area{position:relative;width:160px;}
.logo-circle{
width:150px;height:150px;border:2px solid #f37b7b;border-radius:50%;
display:flex;align-items:center;justify-content:center;background:#fff;overflow:hidden;}
.logo-circle img{width:80%;}
.camera-icon{
position:absolute;bottom:10px;right:15px;background:#555;color:#fff;
width:28px;height:28px;border-radius:8px;display:flex;
align-items:center;justify-content:center;font-size:14px;}


/* TOGGLE */
.toggle {
    position: relative;
    display: inline-block;
    width: 15px;   /* panjang ideal */
    height: 30px;  /* tinggi ideal */
}

.toggle input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    inset: 0;
    cursor: pointer;
    background-color: #e5e5e5;
    border-radius: 50px;
    transition: .3s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.slider::before {
    content: "";
    position: absolute;
    width: 20px;
    height: 20px;
    left: 5px;
    top: 5px;
    background: #fff;
    border-radius: 50%;
    transition: .3s;
    box-shadow: 0 2px 4px rgba(0,0,0,0.25);
}

/* SAAT ON */
.toggle input:checked + .slider {
    background: #ff8a8a;
    box-shadow: 0 3px 8px rgba(255,138,138,0.5);
}

.toggle input:checked + .slider::before {
    transform: translateX(45px); /* pas dengan width 36 */
}
/* KHUSUS untuk switch di form-group, biar tidak ikut melebar */
.form-group .form-control {
    display: flex;          /* tetap rapi */
    align-items: center;    /* center vertikal */
}

.form-group .form-control .toggle {
    width: 75px;            /* ukuran yang kamu mau */
    flex: 0 0 75px;         /* JANGAN boleh grow */
}

.form-group .form-control .toggle .slider {
    width: 75px;            /* paksa track pink cuma 45px */
    inset: auto;            /* matikan tarikan full dari inset:0 */
    left: 0;
    right: auto;
    top: 0;
    bottom: 0;
}


</style>
</head>

<body>

<div class="top-bar">
<div class="header-left"><h2>Pengaturan</h2></div>

<div class="search-box">
<i class='bx bx-search search-icon'></i>
<input type="text" placeholder="Cari...">
</div>

<div class="right-menu">
<div class="badge">
    <img src="https://flagcdn.com/w20/id.png" alt="ID">
    <span>ID</span>
    <i class='bx bx-chevron-down'></i>
</div>


<div class="notif"><i class='bx bx-bell'></i></div>

<div class="profile">
    <div class="avatar">Y</div>

    <div class="profile-text">
        <div class="name">Yolanda</div>
        <div class="role">Admin</div>
    </div>

    <i class='bx bx-chevron-down'></i>
</div>

</div>
</div>

<div class="card">
<h3>Pengaturan Umum</h3>

<div class="form-group">
<label>Tema Sistem</label>
<div class="form-control">
<select class="select-tema">
<option>Terang</option>
<option>Gelap</option>
</select>
</div>
</div>

<div class="form-group">
<label>Nama Toko</label>
<div class="form-control">
<input type="text" value="Hara Hijab Needs">
</div>
</div>

<div class="form-group">
<label>Alamat</label>
<div class="form-control">
<textarea>Jend. Sudirman No.221, Indramayu...</textarea>
</div>
</div>

<div class="form-group">
<label>Logo</label>
<div class="form-control">
<div class="logo-area">
<div class="logo-circle">
<img src="{{ asset('logo.png') }}">
</div>
<div class="camera-icon"><i class='bx bx-camera'></i></div>
</div>
</div>
</div>

<div class="form-group">
    <label class="form-label">Notifikasi ke Pengguna</label>
    <div class="form-control">
        <label class="toggle">
            <input type="checkbox" checked>
            <span class="slider"></span>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="form-label">Mode Perbaikan</label>
    <div class="form-control">
        <label class="toggle">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
    </div>
</div>

<div class="form-group">
<label>API Key</label>
<div class="form-control">
<input type="text" value="AHDU5793hytr0dkks65720103uhdyYHNJhyio;">
</div>
</div>

<div class="form-group">
<label>Link Sosial Media</label>
<div class="form-control">
<input type="text" value="https://harahijabneeds.com">
</div>
</div>

</div>

</body>
</html>
