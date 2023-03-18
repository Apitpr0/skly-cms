<?php
include "components/navbar.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/line-clamp'),
    ],
  }
    </script>
    <title>SKLY-CMS - Blog</title>
</head>
<body>
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:mx-0">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Blog Kaunseling</h2>
      <p class="mt-2 text-lg leading-8 text-gray-600">Informasi dari Unit Kaunseling</p>
    </div>
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
        </div>
        <div class="group relative">
          <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
            <a href="#">
              <span class="absolute inset-0"></span>
              Info Terkini
            </a>
          </h3>
          <p class="mt-5 text-sm font-semibold leading-6 text-gray-700 line-clamp-3">Cara Rawatan Penyakit Mental </p>
          <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3">Jenis-Jenis Penyakit Mental Yang Perlukan Rawatan:- Neurosis & Psikosis Penyakit mental organik seperti nyanyuk Gangguan personaliti Psikiatri di kalangan kanak-kanak seperti autism dan hipe... </p>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4">
          <div class="text-sm leading-6">
            <p class="font-semibold text-gray-900">
            <a href="https://mmha.org.my/article-listing/bahasa-malaysia/cara-rawatan-penyakit-mental"> Read more..</a>
            </p>

          </div>
        </div>
      </article>

      <!-- More posts... -->
    </div>
  </div>
</div>
</body>

</html>
