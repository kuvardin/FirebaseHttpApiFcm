<?php

declare(strict_types=1);

namespace Kuvardin\FirebaseHttpApiFcm;

/**
 * Class Target
 *
 * @package Kuvardin\FirebaseHttpApiFcm
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Target
{
    /**
     * @var string|null
     */
    protected ?string $token = null;

    /**
     * @var string|null
     */
    protected ?string $topic = null;

    /**
     * @var string|null
     */
    protected ?string $condition = null;

    /**
     * @var string[]|null
     */
    protected ?array $registration_ids = null;

    /**
     * Target constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $token
     * @return $this
     */
    public static function createWithToken(string $token): self
    {
        $target = new self;
        $target->token = $token;
        return $target;
    }

    /**
     * @param string $topic
     * @return $this
     */
    public static function createWithTopic(string $topic): self
    {
        $target = new self;
        $target->topic = $topic;
        return $target;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public static function createWithCondition(string $condition): self
    {
        $target = new self;
        $target->condition = $condition;
        return $target;
    }

    /**
     * @param string[] $registration_ids
     * @return static
     */
    public static function createWithRegistrationIds(array $registration_ids): self
    {
        $target = new self;
        $target->registration_ids = $registration_ids;
        return $target;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return string|null
     */
    public function getTopic(): ?string
    {
        return $this->topic;
    }

    /**
     * @return string|null
     */
    public function getTopicFull(): ?string
    {
        return $this->topic === null ? null : "/topics/{$this->topic}";
    }

    /**
     * @return string|null
     */
    public function getCondition(): ?string
    {
        return $this->condition;
    }

    /**
     * @return string[]|null
     */
    public function getRegistrationIds(): ?array
    {
        return $this->registration_ids;
    }
}
