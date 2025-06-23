<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rate Your Experience</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 50px;
    }

    .stars {
      display: flex;
      justify-content: center;
      gap: 10px;
      font-size: 40px;
      cursor: pointer;
    }

    .star {
      color: lightgray;
      transition: color 0.3s;
    }

    .star.selected {
      color: gold;
    }

    textarea {
      margin-top: 20px;
      width: 60%;
      height: 100px;
      font-size: 16px;
      padding: 10px;
      resize: none;
    }

    button {
      margin-top: 20px;
      padding: 10px 30px;
      background-color: #00b300;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 20px;
      cursor: pointer;
    }

    button:hover {
      background-color:rgb(170, 230, 170);
    }

    .close-button {
      position: absolute;
      right: 30px;
      top: 30px;
      font-size: 30px;
      color: white;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      cursor: pointer;
    }

    .close-button:hover {
      background-color: grey;
    }
  </style>
</head>
<body>

<img class="close-button" src="{{ asset('images/closebtn.png') }}" alt="Close" onclick="window.location.href='{{ route('booking.history') }}'">

  <form action="{{ route('feedback.submit') }}" method="POST">
  @csrf
  <input type="hidden" name="rating" id="rating" value="3">
  <input type="hidden" name="booking_id" value="{{ $booking->bookingID }}">

  <h1 style="padding-top: 50px;">Rate your experience</h1>
  <div class="stars" id="starContainer">
    <span class="star" data-value="1">★</span>
    <span class="star" data-value="2">★</span>
    <span class="star" data-value="3">★</span>
    <span class="star" data-value="4">★</span>
    <span class="star" data-value="5">★</span>
  </div>

  <p>Thanks, what is the reason for your rating?</p>
  <textarea placeholder="Add your feedback" id="feedback">{{ $feedback->comment ?? '' }}</textarea>
<br>

  <button type="button" onclick="submitFeedback()">SUBMIT</button>
</form>

<script>
  const stars = document.querySelectorAll('.star');
let rating = {{ $feedback->rating ?? 3 }};
  updateStars(rating);

  stars.forEach(star => {
    star.addEventListener('click', () => {
      rating = parseInt(star.getAttribute('data-value'));
      updateStars(rating);
    });
  });

  function updateStars(rating) {
    stars.forEach(star => {
      const starValue = parseInt(star.getAttribute('data-value'));
      star.classList.toggle('selected', starValue <= rating);
    });
  }

  function submitFeedback() {
    const feedback = document.getElementById('feedback').value;
    document.getElementById('rating').value = rating;

    let input = document.createElement("input");
    input.type = "hidden";
    input.name = "comment";
    input.value = feedback;
    document.querySelector('form').appendChild(input);

    document.querySelector('form').submit();
  }
</script>

</body>
</html>
