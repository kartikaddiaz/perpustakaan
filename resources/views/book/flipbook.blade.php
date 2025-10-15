<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $book->judul }} - Flipbook</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/css/page-flip.min.css">
  <style>
    body {
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      flex-direction: column;
    }
    #flipbook {
      width: 800px;
      height: 600px;
    }
    .btn {
      text-decoration: none;
      border: 1px solid #999;
      padding: 6px 12px;
      border-radius: 5px;
      color: #333;
      background: #fff;
      transition: 0.2s;
      margin-bottom: 10px;
    }
    .btn:hover {
      background: #eee;
    }
  </style>
</head>
<body>
  <a href="{{ url()->previous() }}" class="btn">⬅️ Kembali</a>

  <div id="flipbook"></div>

  <script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const flipbook = document.getElementById("flipbook");

      const pageFlip = new St.PageFlip(flipbook, {
        width: 600,
        height: 800,
        size: "stretch",
        showCover: true,
        maxShadowOpacity: 0.5,
        mobileScrollSupport: true,
      });

      const pages = [];
      for (let i = 1; i <= 442; i++) {
        const num = String(i).padStart(3, '0');
        pages.push(`/storage/books/Hello, Cello. (Nadia Ristivani) (Z-Library)-page-${num}.jpg`);
      }

      pageFlip.loadFromImages(pages);
    });
  </script>
</body>
</html>
