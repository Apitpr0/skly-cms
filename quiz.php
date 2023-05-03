<?php
include('components/header.php');
include('components/navbar.php');
?>

<body class="bg-gray-200 p-4">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-xl font-bold mb-4">Kenali Diri Anda</h1>
        <form method="POST">
            <?php
            $quiz_questions = array(
                array(
                    "question" => "Bagaimana anda biasanya mengatasi situasi yang menimbulkan stres atau kecemasan di sekolah?",
                    "options" => array("Saya mencuba untuk menghindari situasi tersebut", "Saya bercakap dengan kawan-kawan saya tentang situasi tersebut", "Saya mencari sokongan dari keluarga saya", "Saya cuba untuk bertenang dan bernafas dalam-dalam, dan saya bercakap dengan guru atau kaunselor sekolah saya jika saya memerlukan bantuan")
                ),
                array(
                    "question" => "Seberapa sering anda bercakap dengan kawan atau keluarga anda tentang masalah-masalah pribadi anda?",
                    "options" => array("Jarang Sekali", "Kadang-Kadang", "Sering", "Selalu")
                ),
                array(
                    "question" => "Apa yang anda lakukan jika anda merasa tidak nyaman atau tidak aman di sekolah?",
                    "options" => array("Saya mencuba untuk menghindari situasi tersebut", "Saya bercakap dengan rakan-rakan saya tentang keadaan itu.", "Saya mencari sokongan dari keluarga saya", "Saya bercakap dengan guru atau orang dewasa yang dipercayai di sekolah untuk mendapatkan bantuan")
                ),
                array(
                    "question" => "Bagaimana anda rancang dan mengatur waktu anda untuk menyelesaikan tugas-tugas sekolah?",
                    "options" => array("Saya menyelesaikan tugas-tugas saya secepat mungkin, tanpa perlu rancang atau mengatur waktu", "Saya membuat jadual untuk menyelesaikan tugas-tugas saya", "Saya menyelesaikan tugas-tugas saya pada minit terakhir", "Saya meminta bantuan orang lain untuk menyelesaikan tugas-tugas saya")
                ),
                array(
                    "question" => "Apakah anda biasanya mengambil tanggung jawab untuk tugas-tugas sekolah atau lebih suka bergantung dengan orang lain?",
                    "options" => array("Saya biasanya mengambil tanggung jawab untuk tugas-tugas sekolah", "Saya lebih suka bergantung kepada orang lain untuk menyelesaikan tugas-tugas saya", "Saya mengambil tanggung jawab untuk beberapa tugas, tetapi bergantung kepada orang lain untuk yang lainnya", "Saya tidak suka menyelesaikan tugas-tugas sekolah")
                )
            );

            foreach ($quiz_questions as $key => $question) {
                echo '<div class="my-4">';
                echo '<p class="font-bold">' . $question['question'] . '</p>';
                foreach ($question['options'] as $option) {
                    echo '<label class="inline-flex items-center mt-2 ml-4">';
                    echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="' . $option . '">';
                    echo '<span class="ml-2">' . $option . '</span>';
                    echo '</label>';
                }
                echo '</div>';
            }
            ?>
            <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" type="submit" name="submit">Submit Quiz</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $user_answers = $_POST['answer'];
            $score = 0;
            foreach ($user_answers as $key => $answer) {
                if ($answer == $quiz_questions[$key]['answer']) {
                    $score++;
                }
            }
            echo '<p class="mt-4">Your score is ' . $score . ' out of ' . count($quiz_questions) . '.</p>';
        }
        ?>
    </div>
    <?php include('components/footer.php'); ?>