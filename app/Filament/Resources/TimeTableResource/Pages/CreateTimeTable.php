<?php

namespace App\Filament\Resources\TimeTableResource\Pages;

use Throwable;
use Filament\Actions;
use Filament\Support\Exceptions\Halt;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Facades\FilamentView;
use App\Filament\Resources\TimeTableResource;

use function Filament\Support\is_app_url;
class CreateTimeTable extends CreateRecord
{
    protected static string $resource = TimeTableResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $infos['academic_year_id'] = $data['academic_year_id'];
        $infos['period_id'] = $data['period_id'];
        $infos['classe_id'] = $data['classe_id'];
        $infos['subject_id'] = $data['subject_id'];
        $infos['teacher_id'] = $data['teacher_id'];
        // dd($data['Informations Horaires']);
        $datas = [];
        for ($i = 1; $i < count($data['Informations Horaires']); $i++)
        {
            foreach ($data['Informations Horaires'] as $key => $value)
            {
                foreach ($value as $key => $valu)
                {
                    $infos[$key] = $valu;
                }
                array_push($datas, $infos);
            }
        }
        return $datas;
    }

    public function create(bool $another = false): void
    {
        $this->authorizeAccess();

        try {
            $this->beginDatabaseTransaction();

            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeCreate($data);

            $this->callHook('beforeCreate');
            foreach ($data as $key => $value)
            {
                for ($i = 1; $i < count($data); $i++)
                {
                    $this->record = $this->handleRecordCreation($value);
                    $this->form->model($this->getRecord())->saveRelationships();

                    $this->callHook('afterCreate');

                    $this->commitDatabaseTransaction();
                }
            }

        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                $this->rollBackDatabaseTransaction() :
                $this->commitDatabaseTransaction();

            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();

            throw $exception;
        }

        $this->rememberData();

        $this->getCreatedNotification()?->send();

        if ($another) {
            // Ensure that the form record is anonymized so that relationships aren't loaded.
            $this->form->model($this->getRecord()::class);
            $this->record = null;

            $this->fillForm();

            return;
        }

        $redirectUrl = $this->getRedirectUrl();

        $this->redirect($redirectUrl, navigate: FilamentView::hasSpaMode() && is_app_url($redirectUrl));
    }
}
