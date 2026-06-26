<?php

namespace App\Services;

use Exception;

class EmploymentPredictionService
{
    public function predict(array $profile): array
    {
        $script = base_path('ml/scripts/predict_employment_type.py');

        $payload = json_encode($profile);

        $process = proc_open(
            ['python', $script, $payload],
            [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes
        );

        if (!is_resource($process)) {
            throw new Exception('Unable to start Python prediction process.');
        }

        $output = stream_get_contents($pipes[1]);
        $error = stream_get_contents($pipes[2]);

        fclose($pipes[1]);
        fclose($pipes[2]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0) {
            throw new Exception('Python prediction failed: ' . $error);
        }

        $result = json_decode($output, true);

        if (!$result) {
            throw new Exception('Invalid JSON returned from Python: ' . $output);
        }

        if (isset($result['error'])) {
            throw new Exception('Prediction error: ' . $result['error']);
        }

        return $result;
    }
}
