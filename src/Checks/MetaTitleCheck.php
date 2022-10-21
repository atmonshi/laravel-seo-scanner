<?php 

namespace Vormkracht10\Seo\Checks;

class MetaTitleCheck implements CheckInterface
{
    public string $title = "Check if the title on the homepage does not contain 'home'";

    public string $priority = 'medium';

    public int $timeToFix = 1;

    public bool $checkSuccessful = false;

    public function handle(string $url, string $response): self
    {
        $title = $this->getTitle($response);

        if (str_contains($title, 'home') || ! $title) {
            $this->checkSuccessful = false;

            return $this;
        }

        $this->checkSuccessful = true;

        return $this;
    }

    private function getTitle(string $response): string|null
    {
        preg_match('/<title>(.*)<\/title>/', $response, $matches);

        return $matches[1] ?? null;
    }
}