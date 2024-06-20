<?php

namespace App\Twig;

use App\Repository\GroupRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GroupExtension extends AbstractExtension
{
    public function __construct(
        private readonly GroupRepository $repository,
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('groups', [$this, 'getGroups']),
        ];
    }

    public function getGroups(): array
    {
        return $this->repository->findAll();
    }
}