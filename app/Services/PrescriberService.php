<?php

namespace App\Services;

class PrescriberService
{
    public function __construct(
        private readonly PrescriberInterface $prescriber,
        private readonly SpecialityInterface $speciality,
        private readonly ConsultationInterface $consultation
    ) {
    }

    public function index()
    {
        return $this->prescriber->all();
    }

    public function show(int $id)
    {
        return $this->prescriber->find($id);
    }

    public function findConsultationById(int $consultation_id)
    {
        return $this->prescriber->findConsultationById($consultation_id);
    }

    public function findSpecialityById (int $speciality_id)
    {
        return $this->prescriber->findSpecialityById($speciality_id);
    }

    public function findExistingIds (array $attributes): bool|string
    {
        if (!$this->speciality->find($attributes['speciality_id'])) {
            return 'prescriber_KO';
        }

        if (!$this->consultation->find($attributes['consultation_id'])) {
            return 'patient_KO';
        }
        return 'OK';
    }

    public function store(array $attributes)
    {
        $message = $this->findExistingIds($attributes);

        if ($message === 'OK') {
            return $this->prescriber->create($attributes);
        } else {
            return $message;
        }
    }

    public function update(array $attributes, int $id)
    {
        $message = $this->findExistingIds($attributes);

        if ($message === 'OK') {
            return $this->prescriber->update($attributes, $id);
        } else {
            return $message;
        }
    }

    public function delete(int $id)
    {
        return $this->prescriber->delete($id);
    }


}
