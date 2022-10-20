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

    private function generateUUIdString($model, $existedUuid): ?string
    {
        $uuidStr = \Ramsey\Uuid\Uuid::uuid4()->toString();

        if (in_array($uuidStr, $existedUuid))
            return $this->generateUUIdString($model, $existedUuid);

        return $uuidStr;
    }
}
