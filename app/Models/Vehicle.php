<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Vehicle extends Model
{
    use HasFactory;

    // Campos que se van a asignación masiva
    protected $fillable = [
        'marca', 
        'modelo', 
        'person_id'
    ];

    // Relaciones permitidas para incluir
    protected $allowIncluded = ['person', 'fines', 'accident'];

    // Campos permitidos para filtrado
    protected $allowFilter = ['id', 'marca', 'modelo', 'person_id'];

    // Campos permitidos para ordenamiento
    protected $allowSort = ['id', 'marca', 'modelo', 'person_id'];



    // Relación uno a muchos con Person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Relación uno a muchos con Fines
    public function Fines()
    {
        return $this->hasMany(Fines::class);
    }

    // Relación muchos a muchos con Accident
    public function accident()
    {
        return $this->belongsToMany(Accident::class);
    }

     // Scope para incluir relaciones
     public function scopeIncluded(Builder $query)
     {
         if (empty($this->allowIncluded) || empty(request('included'))) {
             return;
         }
 
         $relations = explode(',', request('included'));
         $allowIncluded = collect($this->allowIncluded);
 
         foreach ($relations as $key => $relationship) {
             if (!$allowIncluded->contains($relationship)) {
                 unset($relations[$key]);
             }
         }
         $query->with($relations);
     }
 
     // Scope para filtrar resultados
     public function scopeFilter(Builder $query)
     {
         if (empty($this->allowFilter) || empty(request('filter'))) {
             return;
         }
 
         $filters = request('filter');
         $allowFilter = collect($this->allowFilter);
 
         foreach ($filters as $filter => $value) {
             if ($allowFilter->contains($filter)) {
                 $query->where($filter, 'LIKE', '%' . $value . '%');
             }
         }
     }
 
     // Scope para ordenar resultados
     public function scopeSort(Builder $query)
     {
         if (empty($this->allowSort) || empty(request('sort'))) {
             return;
         }
 
         $sortFields = explode(',', request('sort'));
         $allowSort = collect($this->allowSort);
 
         foreach ($sortFields as $sortField) {
             $direction = 'asc';
 
             if (substr($sortField, 0, 1) == '-') {
                 $direction = 'desc';
                 $sortField = substr($sortField, 1);
             }
             if ($allowSort->contains($sortField)) {
                 $query->orderBy($sortField, $direction);
             }
         }
     }
 
     // Scope para obtener o paginar resultados
     public function scopeGetOrPaginate(Builder $query)
     {
         if (request('perPage')) {
             $perPage = intval(request('perPage'));
 
             if ($perPage) {
                 return $query->paginate($perPage);
             }
         }
         return $query->get();
     }
}