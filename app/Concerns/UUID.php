<?php

namespace App\Concerns;

trait UUID
{
    public function generateUUId($model = null, $column = 'uuid'): ?string
    {
        $model = $model ?? $this;

        $existedUuid = $model::pluck($column)->toArray();

        return $this->generateUUIdString($model, $existedUuid);
    }

    public function generateAPIKey(): string
    {
        return $this->uuid();
    }

    private function generateUUIdString($model, $existedUuid): ?string
    {
        $uuidStr = $this->uuid();

        if (in_array($uuidStr, $existedUuid))
            return $this->generateUUIdString($model, $existedUuid);

        return $uuidStr;
    }

    private function uuid(): string
    {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}
