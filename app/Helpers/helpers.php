<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

if (!function_exists('setting')) {
    /**
     * Get setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        static $settings = null;
        
        if ($settings === null) {
            try {
                $settings = Setting::all()->pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                $settings = [];
            }
        }
        
        return $settings[$key] ?? $default;
    }
}

if (!function_exists('whatsapp_link')) {
    /**
     * Generate WhatsApp link
     *
     * @param string $phone
     * @param string $message
     * @return string
     */
    function whatsapp_link($phone, $message = '')
    {
        // Remove non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Add country code if not present (Indonesia = 62)
        if (substr($phone, 0, 2) !== '62') {
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            }
        }
        
        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }
}

if (!function_exists('format_rupiah')) {
    /**
     * Format number to Rupiah currency
     *
     * @param float|int $number
     * @return string
     */
    function format_rupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('get_years')) {
    /**
     * Get range of years
     *
     * @param int $start
     * @param int|null $end
     * @return array
     */
    function get_years($start = 2020, $end = null)
    {
        $end = $end ?? date('Y');
        return range($end, $start);
    }
}

if (!function_exists('upload_file')) {
    /**
     * Upload file to storage
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string|null $oldFile
     * @return string
     */
    function upload_file($file, $path, $oldFile = null)
    {
        // Delete old file if exists
        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }
        
        // Upload new file
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $filename, 'public');
        
        return $filePath;
    }
}

if (!function_exists('delete_file')) {
    /**
     * Delete file from storage
     *
     * @param string|null $filePath
     * @return bool
     */
    function delete_file($filePath)
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }
        
        return false;
    }
}

if (!function_exists('get_file_url')) {
    /**
     * Get file URL
     *
     * @param string|null $filePath
     * @param string $default
     * @return string
     */
    function get_file_url($filePath, $default = 'images/default.jpg')
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            return asset('storage/' . $filePath);
        }
        
        return asset($default);
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate text to specified length
     *
     * @param string $text
     * @param int $length
     * @param string $suffix
     * @return string
     */
    function truncate_text($text, $length = 100, $suffix = '...')
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        
        return substr($text, 0, $length) . $suffix;
    }
}

if (!function_exists('get_status_badge')) {
    /**
     * Get Bootstrap badge class for status
     *
     * @param string $status
     * @return string
     */
    function get_status_badge($status)
    {
        $badges = [
            'menunggu' => 'warning',
            'disetujui' => 'success',
            'ditolak' => 'danger',
            'selesai' => 'info',
            'aktif' => 'success',
            'nonaktif' => 'secondary',
        ];
        
        return $badges[$status] ?? 'secondary';
    }
}

if (!function_exists('get_status_label')) {
    /**
     * Get status label in Indonesian
     *
     * @param string $status
     * @return string
     */
    function get_status_label($status)
    {
        $labels = [
            'menunggu' => 'Menunggu Konfirmasi',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
        ];
        
        return $labels[$status] ?? $status;
    }
}