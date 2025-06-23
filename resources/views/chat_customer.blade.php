@extends('layouts.app')
@section('content')
@include('navbar')

<div class="email-container">
    <h2><span class="highlight">Send Message</span> To Us Now!</h2>

    <form id="mailForm" onsubmit="openMailApp(event)">
        <div class="form-group-inline">
            <input type="text" id="name" class="email-input" placeholder="Full Name" required>
        </div>

        <div class="form-group-inline">
            <input type="text" id="subject" class="email-input" placeholder="Email Subject" required>
        </div>

        <textarea id="message" class="email-textarea" placeholder="Your Message" required></textarea>

        <button type="submit" class="email-btn">Send Email</button>
    </form>
</div>

<script>
    function openMailApp(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const message = document.getElementById('message').value;

        const companyEmail = "haizad7171@gmail.com"; 
        const subject = encodeURIComponent("New Chat Message from " + name);
        const body = encodeURIComponent("From: " + name + "\n\n" + message);

        window.location.href = `mailto:${companyEmail}?subject=${subject}&body=${body}`;
    }
</script>

<style>


.email-container {
    background-color: #0d1b4c;
    padding: 40px;
    border-radius: 15px;
    max-width: 700px;
    margin: 50px auto;
    color: #fff;
    text-align: center;
}

.email-container h2 {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 25px;
}

.email-container .highlight {
    color: #e6b800;
}

.form-group-inline {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.email-input {
    flex: 1;
    padding: 15px;
    border: 2px solid #e6b800;
    border-radius: 8px;
    background-color: transparent;
    color: #fff;
    font-size: 16px;
}

.email-input::placeholder {
    color: #ccc;
}

.email-textarea {
    width: 100%;
    padding: 15px;
    border: 2px solid #e6b800;
    border-radius: 8px;
    background-color: transparent;
    color: #fff;
    font-size: 16px;
    min-height: 150px;
    margin-bottom: 20px;
}

.email-textarea::placeholder {
    color: #ccc;
}

.email-btn {
    background-color: #e6b800;
    color: #000;
    padding: 12px 30px;
    border: none;
    border-radius: 30px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.email-btn:hover {
    background-color: #fff;
}
</style>
@endsection
