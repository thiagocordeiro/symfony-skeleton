<?php declare(strict_types=1);

namespace App\Framework\EventListener;

use JsonSerializable;

class ErrorDetail implements JsonSerializable
{
    private string $class;
    private string $message;
    private string $file;
    private int $line;
    private ?ErrorDetail $previous;

    public function __construct(string $class, string $message, string $file, int $line, ?ErrorDetail $previous)
    {
        $this->class = $class;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
        $this->previous = $previous;
    }

    /**
     * @return string[]|int[]
     */
    public function jsonSerialize(): array
    {
        return [
            'class' => $this->class,
            'message' => $this->message,
            'file' => $this->file,
            'line' => $this->line,
            'previous' => json_encode($this->previous),
        ];
    }
}
