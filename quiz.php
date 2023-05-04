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
                    "score" => 1
                ),
                array(
                    "question" => "Seberapa sering anda bercakap dengan kawan atau keluarga anda tentang masalah-masalah pribadi anda?",
                    "score" => 1
                ),
                array(
                    "question" => "Apa yang anda lakukan jika anda merasa tidak nyaman atau tidak aman di sekolah?",
                    "score" => 1
                ),
                array(
                    "question" => "Bagaimana anda rancang dan mengatur waktu anda untuk menyelesaikan tugas-tugas sekolah?",
                    "score" => 1
                ),
                array(
                    "question" => "Apakah anda biasanya mengambil tanggung jawab untuk tugas-tugas sekolah atau lebih suka bergantung dengan orang lain?",
                    "score" => 1
                )
            );

            foreach ($quiz_questions as $key => $question) {
                echo '<div class="my-4">';
                echo '<p class="font-bold">' . $question['question'] . '</p>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="1">';
                echo '<span class="ml-2">1</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="2">';
                echo '<span class="ml-2">2</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="3">';
                echo '<span class="ml-2">3</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="4">';
                echo '<span class="ml-2">4</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="5">';
                echo '<span class="ml-2">5</span>';
                echo '</label>';
                echo '</div>';
            }

            ?>
            <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" type="submit" name="submit">Hantar</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $user_answers = $_POST['answer'];
            $score = 0;
            foreach ($user_answers as $key => $answer) {
                if (isset($quiz_questions[$key])) {
                    $score += $answer;
                }
            }
            if ($score < 10) {
                echo "<p class='mt-4 font-bold'>Anda mungkin perlu mencari bantuan dari teman atau orang dewasa untuk mengatasi stres anda.</p>";
            } else if ($score < 15) {
                echo "<p class='mt-4 font-bold'>Anda memiliki beberapa strategi yang baik untuk mengatasi stres dan kecemasan, tetapi mungkin masih perlu beberapa bantuan dari waktu ke waktu.</p>";
            } else {
                echo "<p class='mt-4 font-bold'>Anda memiliki strategi yang baik untuk mengatasi stres dan kecemasan, dan mampu mengatasi situasi yang menantang dengan baik.</p>";
            }
        }
        ?>