<?php

namespace CodeZero\UniqueTranslation;

class UniqueTranslationRule
{
    /**
     * @var string
     */
    protected $rule = 'unique_translation';

    /**
     * The table to run the query against.
     *
     * @var string
     */
    protected $table;

    /**
     * The column to check on.
     *
     * @var string|null
     */
    protected $column;

    /**
     * The value of the the 'ignoreColumn' to ignore.
     *
     * @var mixed
     */
    protected $ignoreValue;

    /**
     * The name of the 'ignoreColumn'.
     *
     * @var string|null
     */
    protected $ignoreColumn;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string|null $column
     *
     * @return static
     */
    public static function for($table, $column = null)
    {
        return new static($table, $column);
    }

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string|null $column
     */
    public function __construct($table, $column = null)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Ignore any record that has a column with the given value.
     *
     * @param mixed $value
     * @param string $column
     *
     * @return $this
     */
    public function ignore($value, $column = 'id')
    {
        $this->ignoreValue = $value;
        $this->ignoreColumn = $column;

        return $this;
    }

    /**
     * Generate a string representation of the validation rule.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '%s:%s,%s,%s,%s',
            $this->rule,
            $this->table,
            $this->column ?: 'NULL',
            $this->ignoreValue ?: 'NULL',
            $this->ignoreColumn ?: 'NULL'
        );
    }
}
