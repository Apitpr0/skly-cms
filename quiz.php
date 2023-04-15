<?php
include('components/header.php');
include('components/navbar.php');
?>

<body class="bg-gray-200 p-4">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-xl font-bold mb-4">PHP Quiz</h1>
        <form method="POST">
            <?php
            $quiz_questions = array(
                array(
                    "question" => "What is the capital of France?",
                    "options" => array("London", "Paris", "Berlin", "Madrid"),
                    "answer" => "Paris"
                ),
                array(
                    "question" => "What is the highest mountain in the world?",
                    "options" => array("Mount Kilimanjaro", "Mount Everest", "Mount Denali", "Mount Aconcagua"),
                    "answer" => "Mount Everest"
                ),
                array(
                    "question" => "Who invented the telephone?",
                    "options" => array("Thomas Edison", "Alexander Graham Bell", "Nikola Tesla", "Guglielmo Marconi"),
                    "answer" => "Alexander Graham Bell"
                )
            );

            foreach ($quiz_questions as $key => $question) {
                echo '<div class="my-4">';
                echo '<p class="font-bold">' . $question['question'] . '</p>';
                foreach ($question['options'] as $option) {
                    echo '<label class="inline-flex items-center mt-2">';
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
