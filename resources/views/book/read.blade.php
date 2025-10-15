<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $book->judul }} - Flipbook</title>

  <link rel="stylesheet" href="https://unpkg.com/st-pageflip/dist/pageflip.css">
  <script src="https://unpkg.com/st-pageflip/dist/pageflip.browser.js"></script>

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background: #f4f4f4;
      height: 100vh;
      margin: 0;
      font-family: "Poppins", sans-serif;
    }

    #flipbook {
      width: 800px;
      height: 500px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      background: white;
      border-radius: 8px;
    }

    .btn {
      text-decoration: none;
      border: 1px solid #999;
      padding: 6px 12px;
      border-radius: 5px;
      color: #333;
      background: #fff;
      transition: 0.2s;
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .btn:hover {
      background: #eee;
    }
  </style>
</head>
<body>

  <a href="{{ url()->previous() }}" class="btn">⬅️ Kembali</a>

  <div id="flipbook"></div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const flipbook = document.getElementById("flipbook");

      const pageFlip = new St.PageFlip(flipbook, {
        width: 400,
        height: 500,
        size: "stretch",
        showCover: true,
        useMouseEvents: true
      });

      const pages = [];

      // ✅ Karena file kamu ada di: public/books/
      for (let i = 1; i <= 442; i++) {
        const num = String(i).padStart(3, '0');
        pages.push(`/books/Hello, Cello. (Nadia Ristivani) (Z-Library)-page-${num}.jpg`);
      }

      pageFlip.loadFromImages(pages);
    });
  </script>

</body>
</html>
