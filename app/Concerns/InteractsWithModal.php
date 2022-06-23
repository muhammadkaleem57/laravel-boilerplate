<?php


namespace App\Concerns;


trait InteractsWithModal
{
    public function openModal(string $form, $id = null, ?string $event = '', ?string $modalSize = null)
    {
        $this->emitTo('components.modal', 'show::FormModal', $form, $id, $event, $modalSize);
    }

    protected function openConfirmationModal(string $id, string $className, string $type = '', string $message = '', string $event = '')
    {
        $params = [
            'id' => $id,
            'className' => $className,
            'type' => $type ?: 'delete',
            'message' => 'Are you sure you want to '.$message,
            'event' => $event
        ];

        $this->emitTo('components.confirmation-modal', 'show::ConfirmationModal', $params);
    }
}