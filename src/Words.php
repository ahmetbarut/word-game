<?php

namespace AhmetBarut\WordGame;

class Words
{
    /**
     * @var array
     */
    protected array $words;

    /**
     * Words constructor.
     */
    public function __construct()
    {
        $this->parseWords(file_get_contents(__DIR__ . '/words.txt'));
    }

    /**
     * @param string $words
     */
    public function parseWords($words): void
    {
        preg_match_all('/(.*):(.*)/m', $words, $matches, PREG_SET_ORDER, 0);

        foreach ($matches as $match) {
            $this->words[] = [
                'en' => $match[1],
                'tr' => rtrim(trim(str_replace(
                    ['s.', 'i.', 'zf.', 'z.', 'f.', 'bğ.', 'ed.'],
                    '',
                    $match[2]
                ))),
            ];
        }
    }

    /**
     * get matching words
     * @param int $count
     * @return array
     */
    public function getWords(): array
    {
        return $this->words;
    }

    /**
     * get random word
     * @param int $count
     * @return array
     */
    public function getRandomWord(?int $count = 1): array
    {
        $randomWords = [];

        for ($i = 0; $i < $count; $i++) {
            $randomWords[] = $this->words[array_rand($this->words)];
        }
        return $randomWords;
    }

    public function getSpeech($word)
    {
        $soundFileDir = __DIR__ . '/../bin/sound.py';

        if (PHP_OS === 'WINNT') {
            return "python3.9 " . $soundFileDir . " {$word}";
        }

        if (PHP_OS === 'Darwin') {
            return "say -v fred {$word}";
        }

        if (PHP_OS === 'Linux') {
            return "python3.9 " . $soundFileDir . " {$word}";
        }
    }
}
