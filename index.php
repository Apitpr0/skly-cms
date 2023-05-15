<?php
include 'Components\main.php';
?>
<section class="bg-ackground dark:bg-background h-screen flex items-center justify-center">
    <div class="grid max-w-screen-lg md:max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class=" text-al mr-auto lg:col-span-6 md:col-span-7 md:pr-8">
            <h1 class="bg-card p-4 rounded-lg text-text text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold yellow leading-tight">
                Cari Kaunselor Untuk Membantu Menyelesaikan Masalah Anda
            </h1>
            <p class="bg-card p-4 rounded-lg mt-6 text-lg text-text md:text-xl mb-8 md:mb-12">
                Cari Kaunselor Yang Tepat Untuk Membantu Anda
            </p>
            <div class="flex flex-col space-y-4 sm:items-center sm:justify-start sm:flex-row sm:space-y-0 sm:space-x-4 lg:justify-start">
                <a href="booking.php" class="px-8 py-3 text-lg md:text-xl font-semibold rounded-full bg-card text-white hover:bg-pink-600 transition duration-200 ease-in-out">Tempah</a>
                <a href="quiz.php" class="px-8 py-3 text-lg md:text-xl font-semibold rounded-full bg-card text-white hover:bg-pink-600 transition duration-200 ease-in-out">Kenali Diri Anda</a>
            </div>
        </div>
        <div class="hidden lg:block text-al mr-auto lg:col-span-6 md:col-span-7 md:pr-8">
            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="Mockup" class=" w-full">
        </div>                
    </div>
</section>
<?php
include 'Components\layout\footer.php';
?>