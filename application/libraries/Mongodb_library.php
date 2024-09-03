<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MongoDB\Client;

include_once 'vendor/autoload.php';

class Mongodb_library
{

    protected $client;
    protected $db;
    protected $collection;
    protected $CI = '';

    public function __construct($db_name = null)
    {
        // Load MongoDB configuration from the config file
        $this->CI = &get_instance();
        $this->CI->config->load('mongodb', TRUE);
        $config = $this->CI->config->item('mongodb');

        // Connect to MongoDB
        $this->client = new Client($config['connection_string']);
        $this->db = $this->client->{$db_name ?: $config['database']};
    }

    public function selectDatabase($db_name)
    {
        // Switch to a different database
        $this->db = $this->client->{$db_name};
    }

    public function selectCollection($collection)
    {
        $this->collection = $this->db->{$collection};
    }

    public function insert($data)
    {
        return $this->collection->insertOne($data);
    }

    public function find($filter = [], $options = [])
    {
        return $this->collection->find($filter, $options)->toArray();
    }

    public function findOne($filter = [], $options = [])
    {
        return $this->collection->findOne($filter, $options);
    }

    public function update($filter, $data, $options = [])
    {
        return $this->collection->updateOne($filter, ['$set' => $data], $options);
    }

    public function delete($filter, $options = [])
    {
        return $this->collection->deleteOne($filter, $options);
    }

    public function toArray($cursor)
    {
        $results = [];
        foreach ($cursor as $document) {
            $results[] = (array)$document;
        }
        return $results;
    }

    public function aggregate($pipeline)
    {
        return $this->collection->aggregate($pipeline)->toArray();
    }

    public function getAll()
    {
        return $this->collection->find()->toArray();
    }

    public function getEntities($filter = [], $options = [])
    {
        return $this->collection->find($filter, $options)->toArray();
    }

    public function getOne($filter = [], $options = [])
    {
        return $this->collection->findOne($filter, $options);
    }

    public function getCol($column, $filter = [], $options = [])
    {
        $options['projection'] = [$column => 1];
        $documents = $this->collection->find($filter, $options)->toArray();

        $result = [];
        foreach ($documents as $doc) {
            $result[] = $doc[$column] ?? null;
        }
        return $result;
    }

    public function getRow($filter = [], $options = [])
    {
        $options['limit'] = 1;
        $result = $this->collection->find($filter, $options)->toArray();
        return !empty($result) ? $result[0] : null;
    }

    public function getAssoc($keyField, $filter = [], $options = [])
    {
        $documents = $this->collection->find($filter, $options)->toArray();
        $result = [];
        foreach ($documents as $doc) {
            $key = $doc[$keyField] ?? null;
            if ($key !== null) {
                $result[$key] = $doc;
            }
        }
        return $result;
    }

    public function orderBy($field, $direction = 'ASC')
    {
        $direction = strtoupper($direction) === 'ASC' ? 1 : -1;
        $this->lastOptions['sort'] = [$field => $direction];
        return $this;
    }

    public function groupBy($field)
    {
        $pipeline = [
            [
                '$group' => [
                    '_id' => '$' . $field,
                    'docs' => ['$push' => '$$ROOT']
                ]
            ]
        ];
        return $this->collection->aggregate($pipeline)->toArray();
    }

    public function offset($offset)
    {
        $this->lastOptions['skip'] = (int)$offset;
        return $this;
    }

    public function limit($limit)
    {
        $this->lastOptions['limit'] = (int)$limit;
        return $this;
    }

    public function join($localField, $foreignField, $as, $foreignCollection)
    {
        $pipeline = [
            [
                '$lookup' => [
                    'from' => $foreignCollection,
                    'localField' => $localField,
                    'foreignField' => $foreignField,
                    'as' => $as
                ]
            ]
        ];
        return $this->collection->aggregate($pipeline)->toArray();
    }

    function countDocuments($filter = [])
    {
        return $this->collection->count($filter);
    }

    function buildMongoShellQuery($filter, $options = [])
    {
        $query = json_encode($filter, JSON_PRETTY_PRINT);
        $query = str_replace(['"', '{', '}'], ['', '{ ', ' }'], $query);
        $query = preg_replace('/\[\s+(.*?)\s+\]/s', '[ $1 ]', $query);

        $optionsString = '';
        if (!empty($options)) {
            $optionsString = ', ' . json_encode($options, JSON_PRETTY_PRINT);
            $optionsString = str_replace(['"', '{', '}'], ['', '{ ', ' }'], $optionsString);
            $optionsString = preg_replace('/\[\s+(.*?)\s+\]/s', '[ $1 ]', $optionsString);
        }

        return "db.collection.find({$query}{$optionsString})";
    }

    public function getVersion()
    {
        $command = new \MongoDB\Driver\Command(['buildInfo' => 1]);
        $info = $this->collection->command($command)->toArray();
        return $info[0]->version ?? 'Version info not available';
    }
}
