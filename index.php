<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
?>
<section class="">
	<div class="container flex flex-col justify-center  p-6 mx-auto sm:py-12 lg:py-24 lg:flex-row lg:justify-around">
		<div class="flex flex-col justify-center p-6 text-center rounded-sm lg:max-w-md xl:max-w-lg lg:text-left">
			<div class="text-center">
				<h1 id="animated-heading" class="text-5xl font-bold leading-none sm:text-6xl">
					Cari Kaunselor Untuk Membantu Menyelesaikan Masalah Anda
				</h1>
			</div>

			<p class="mt-6 text-lg mb-5 text-center">
				Cari Kaunselor Yang Tepat Untuk Membantu Anda
			</p>

			<script>
				const animatedHeading = document.getElementById('animated-heading');

				// Animation function
				function animateText() {
					animatedHeading.classList.add('animate');
				}

				// Call the animation function after a delay
				setTimeout(animateText, 1000);
			</script>

			<style>
				.animate {
					animation: textAnimation 2s ease-in-out;
				}

				@keyframes textAnimation {
					0% {
						opacity: 0;
						transform: translateY(20px);
					}

					100% {
						opacity: 1;
						transform: translateY(0);
					}
				}
			</style>

			<div class="flex flex-col space-y-4 sm:items-center sm:justify-center sm:flex-row sm:space-y-0 sm:space-x-4 lg:justify-start mx-auto">
				<a rel="noopener noreferrer" href="booking.php" class="px-8 py-3 text-lg font-semibold rounded bg-pink-400 text-white">TEMPAH</a>
				<a rel="noopener noreferrer" href="quiz.php" class="px-8 py-3 text-lg font-semibold rounded bg-pink-400 text-white">KENALI DIRI ANDA</a>
			</div>


		</div>
		<div class="flex items-center justify-center p-6 mt-8 lg:mt-0 h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
			<img src="Components/assets/img/test2.jpg" alt="" class="object-contain h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
		</div>
	</div>
</section>
<?php
include('Components/footer.php');
?>