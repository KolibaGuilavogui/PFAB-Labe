<?php

namespace App\Helpers;

class ColorHelper
{
    /**
     * Convertir une classe Bootstrap en classe Tailwind
     */
    public static function toTailwind($bsClass)
    {
        $map = [
            'primary' => 'bg-blue-500',
            'secondary' => 'bg-gray-500',
            'success' => 'bg-green-500',
            'danger' => 'bg-red-500',
            'warning' => 'bg-yellow-500',
            'info' => 'bg-cyan-500',
            'dark' => 'bg-slate-700',
        ];

        return $map[$bsClass] ?? 'bg-gray-500';
    }

    /**
     * Obtenir les variantes de couleur Tailwind (normal et hover)
     */
    public static function getTailwindVariants($bsClass)
    {
        $map = [
            'primary' => [
                'bg' => 'bg-blue-500',
                'hover' => 'hover:bg-blue-600',
            ],
            'secondary' => [
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
            ],
            'success' => [
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
            ],
            'danger' => [
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
            ],
            'warning' => [
                'bg' => 'bg-yellow-500',
                'hover' => 'hover:bg-yellow-600',
            ],
            'info' => [
                'bg' => 'bg-cyan-500',
                'hover' => 'hover:bg-cyan-600',
            ],
            'dark' => [
                'bg' => 'bg-slate-700',
                'hover' => 'hover:bg-slate-800',
            ],
        ];

        return $map[$bsClass] ?? $map['secondary'];
    }
}
