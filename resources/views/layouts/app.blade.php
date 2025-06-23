<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .trail-dot {
        position: fixed;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        background: radial-gradient(circle, #6ee7b7, #3b82f6);
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.6);
        animation: fadeOutScale 0.6s forwards;
    }

    @keyframes fadeOutScale {
        to {
            opacity: 0;
            transform: scale(0.3);
        }
    }
</style>
<!-- Bootstrap 5 JS (for collapse/toggle functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Arimo:ital,wght@0,400;0,700;1,400&family=Konkhmer+Sleokchher&family=Audiowide&display=swap"
        rel="stylesheet" />
</head>
<body>
    @yield('content')
    @yield('scripts')
    <script>
    document.addEventListener('mousemove', function(e) {
        const dot = document.createElement('div');
        dot.classList.add('trail-dot');

        // Use clientX/clientY for scroll-friendly placement
        dot.style.left = `${e.clientX}px`;
        dot.style.top = `${e.clientY}px`;

        document.body.appendChild(dot);

        setTimeout(() => {
            dot.remove();
        }, 600);
    });
</script>

</body>
</html>
