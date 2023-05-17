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
                    "question" => "1. Saya dapati diri saya sukar ditenteramkan ",
                    "score" => 1
                ),
                array(
                    "question" => "2. Saya sedar mulut saya terasa kering",
                    "score" => 1
                ),
                array(
                    "question" => "3. Saya tidak dapat mengalami perasaan positif sama sekali",
                    "score" => 1
                ),
                array(
                    "question" => "4. Saya mengalami kesukaran bernafas (contohnya pernafasan yang laju, tercungap-cungap walaupun tidak melakukan senaman fizikal)",
                    "score" => 1
                ),
                array(
                    "question" => "5. Saya cenderung untuk bertindak keterlaluan dalam sesuatu keadaan",
                    "score" => 1
                ),
                array(
                    "question" => "6. Saya rasa menggeletar (contohnya pada tangan)",
                    "score" => 1
                ),
                array(
                    "question" => "7. Saya rasa saya menggunakan banyak tenaga dalam keadaan cemas",
                    "score" => 1
                ),
                array(
                    "question" => "8. Saya bimbang keadaan di mana saya mungkin menjadi panik dan melakukan perkara yang membodohkan diri sendiri",
                    "score" => 1
                ),
                array(
                    "question" => "9. Saya rasa saya tidak mempunyai apa-apa untuk diharapkan",
                    "score" => 1
                ),
                array(
                    "question" => "10. Saya dapati diri saya semakin gelisah",
                    "score" => 1
                )
            );

            foreach ($quiz_questions as $key => $question) {
                echo '<div class="my-4">';
                echo '<p class="font-bold">' . $question['question'] . '</p>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="1">';
                echo '<span class="ml-2">Selalu</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="2">';
                echo '<span class="ml-2">Kerap</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="3">';
                echo '<span class="ml-2">Kadang-Kadang</span>';
                echo '</label>';
                echo '<label class="inline-flex items-center mt-2 ml-4">';
                echo '<input type="radio" class="form-radio text-indigo-600" name="answer[' . $key . ']" value="4">';
                echo '<span class="ml-2">Jarang</span>';
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
            if ($score < 11) {
                echo "<p class='mt-4 font-bold'>Anda mungkin perlu mencari bantuan dari teman atau orang dewasa untuk mengatasi stres anda.</p>";
            } else if ($score < 30) {
                echo "<p class='mt-4 font-bold'>Anda memiliki beberapa strategi yang baik untuk mengatasi stres dan kecemasan, tetapi mungkin masih perlu beberapa bantuan dari waktu ke waktu.</p>";
            } else {
                echo "<p class='mt-4 font-bold'>Anda memiliki strategi yang baik untuk mengatasi stres dan kecemasan, dan mampu mengatasi situasi yang menantang dengan baik.</p>";
            }
        }
        ?>