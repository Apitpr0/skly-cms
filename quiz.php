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
                    "options" => array("Saya mencuba untuk menghindari situasi tersebut", "Saya bercakap dengan kawan-kawan saya tentang situasi tersebut", "Saya mencari sokongan dari keluarga saya", "Saya cuba untuk bertenang dan bernafas dalam-dalam, dan saya bercakap dengan guru atau kaunselor sekolah saya jika saya memerlukan bantuan"),
                    'answer_key' => '1',
                    'score' => 1
                ),
                array(
                    "question" => "Seberapa sering anda bercakap dengan kawan atau keluarga anda tentang masalah-masalah pribadi anda?",
                    "options" => array("Jarang Sekali", "Kadang-Kadang", "Sering", "Selalu"),
                    'answer_key' => '2',
                    'score' => 1
                ),
                array(
                    "question" => "Apa yang anda lakukan jika anda merasa tidak nyaman atau tidak aman di sekolah?",
                    "options" => array("Saya mencuba untuk menghindari situasi tersebut", "Saya bercakap dengan rakan-rakan saya tentang keadaan itu.", "Saya mencari sokongan dari keluarga saya", "Saya bercakap dengan guru atau orang dewasa yang dipercayai di sekolah untuk mendapatkan bantuan"),
                    'answer_key' => '3',
                    'score' => 1
                ),
                array(
                    "question" => "Bagaimana anda rancang dan mengatur waktu anda untuk menyelesaikan tugas-tugas sekolah?",
                    "options" => array("Saya menyelesaikan tugas-tugas saya secepat mungkin, tanpa perlu rancang atau mengatur waktu", "Saya membuat jadual untuk menyelesaikan tugas-tugas saya", "Saya menyelesaikan tugas-tugas saya pada minit terakhir", "Saya meminta bantuan orang lain untuk menyelesaikan tugas-tugas saya"),
                    'answer_key' => '4',
                    'score' => 1
                ),
                array(
                    "question" => "Apakah anda biasanya mengambil tanggung jawab untuk tugas-tugas sekolah atau lebih suka bergantung dengan orang lain?",
                    "options" => array("Saya biasanya mengambil tanggung jawab untuk tugas-tugas sekolah", "Saya lebih suka bergantung kepada orang lain untuk menyelesaikan tugas-tugas saya", "Saya mengambil tanggung jawab untuk beberapa tugas, tetapi bergantung kepada orang lain untuk yang lainnya", "Saya tidak suka menyelesaikan tugas-tugas sekolah"),
                    'answer_key' => '5',
                    'score' => 1
                )
            );
            foreach ($quiz_questions as $key => $question) {
                echo '<div class="my-4">';
                echo '<p class="font-bold">' . $question['question'] . '</p>';
                foreach ($question['options'] as $option_key => $option) {
                    echo '<label class="inline-flex items-center mt-2 ml-4">';
                    echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="' . $option_key . '">';
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
                if (isset($quiz_questions[$key]) && $answer == $quiz_questions[$key]['answer_key']) {
                    $score += $quiz_questions[$key]['score'];
                }
            }
        }

        ?>