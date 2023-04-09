<?php

namespace App\Services\Employees\Upload;

use App\Contracts\Employees\UploadServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Throwable;

class CSVService implements UploadServiceContract
{
    /**
     * Параметр $file содержит объект класcа Illuminate\Http\UploadedFile
     * с текстовым файлом (.csv) в виде
     *
     * Пример CSV-файла со списком сотрудников (одна колонка "Имя"):
     * ```
     *  Иванов Илья
     *  Семенов Марк
     *  Петрова Татьяна
     *  Андреева Анна
     *  Горшков Дмитрий
     *  Сергеева Дарья
     * ```
     *
     * Возвращает коллекцию ассоциативных массивов следующего вида:
     * [
     *      ['first_name' => 'Иван', 'last_name' => 'Иванов']
     *      ['first_name' => 'Марк', 'last_name' => 'Семенов']
     *      ['first_name' => 'Анна', 'last_name' => 'Андреева']
     * ]
     * в случае пустого файла возвращает пустую коллекцию.
     *
     * @param UploadedFile $file
     * @return Collection
     */
    public function parse(UploadedFile $file): Collection
    {
        if ($file->getContent() === '') {
            return new Collection();
        }

        $rows = $this->readCSV($file);
        // Проверяем на наличие заголовка
        if (strip_tags($rows[0][0] === 'Имя')) {
            // При наличии заголовка удаляем из массива
            array_shift($rows);
        }
        $collection = new Collection();
        foreach ($rows as $data) {
            if (!is_array($data) || !array_key_exists(0, $data)) {
                continue;
            }

            $row = $data[0];
            if (!is_string($row)) {
                continue;
            }
            if (!str_contains(trim($row), ' ')) {
                continue;
            }
            $parts = explode(' ', $row);
            $collection->add([
                'first_name' => trim($parts[1]),
                'last_name' => trim($parts[0])
            ]);
        }

        return $collection;
    }

    /**
     * Чтение .csv файла.
     * @param UploadedFile $file
     * @param string $delimiter
     * @return array
     */
    private function readCSV(UploadedFile $file, string $delimiter = ',')
    {
        $lines = [];
        try {
            $file_handle = fopen($file, 'r');
        } catch (\Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
        while (!feof($file_handle)) {
            $lines[] = fgetcsv($file_handle, 512, $delimiter);
        }
        fclose($file_handle);

        return $lines;
    }
}
