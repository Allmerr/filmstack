<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Filmstack - Track films you've watched.</title>
    <meta name="description" content="The social network for film lovers." />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#00e054', // The iconic green
              primaryHover: '#00b042',
              dark: '#14181c', // Main background
              darker: '#0c1014', // Header/Footer
              surface: '#2c3440', // Card background
              textMuted: '#99aabb',
              textLight: '#ffffff',
            },
            fontFamily: {
              sans: ['Graphik', 'Helvetica', 'Arial', 'sans-serif'],
            }
          }
        }
      }
    </script>
    <style>
      body {
        background-color: #14181c;
        color: #99aabb;
      }
      /* Hide scrollbar for clean horizontal scrolling if needed, customized for premium feel */
      ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
      }
      ::-webkit-scrollbar-track {
        background: #14181c;
      }
      ::-webkit-scrollbar-thumb {
        background: #2c3440;
        border-radius: 4px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #445566;
      }
    </style>
    @stack('css')

</script>
</head>
<body class="flex flex-col min-h-screen">
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
    @stack('js')
    <script>
        // Mobile Menu Logic
      const mobileMenuBtn = document.getElementById('mobile-menu-btn');
      const mobileMenuClose = document.getElementById('mobile-menu-close');
      const mobileMenu = document.getElementById('mobile-menu');

      if (mobileMenuBtn && mobileMenuClose && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
          mobileMenu.classList.remove('hidden');
          mobileMenu.classList.add('flex');
          document.body.style.overflow = 'hidden'; // Prevent scrolling
        });

        mobileMenuClose.addEventListener('click', () => {
          mobileMenu.classList.add('hidden');
          mobileMenu.classList.remove('flex');
          document.body.style.overflow = ''; // Restore scrolling
        });
      }
    </script>
  </body>
</html>