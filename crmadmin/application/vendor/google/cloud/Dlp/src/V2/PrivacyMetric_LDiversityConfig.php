<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * l-diversity metric, used for analysis of reidentification risk.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.PrivacyMetric.LDiversityConfig</code>
 */
class PrivacyMetric_LDiversityConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Set of quasi-identifiers indicating how equivalence classes are
     * defined for the l-diversity computation. When multiple fields are
     * specified, they are considered a single composite key.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2.FieldId quasi_ids = 1;</code>
     */
    private $quasi_ids;
    /**
     * Sensitive field for computing the l-value.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId sensitive_attribute = 2;</code>
     */
    private $sensitive_attribute = null;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * Set of quasi-identifiers indicating how equivalence classes are
     * defined for the l-diversity computation. When multiple fields are
     * specified, they are considered a single composite key.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2.FieldId quasi_ids = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getQuasiIds()
    {
        return $this->quasi_ids;
    }

    /**
     * Set of quasi-identifiers indicating how equivalence classes are
     * defined for the l-diversity computation. When multiple fields are
     * specified, they are considered a single composite key.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2.FieldId quasi_ids = 1;</code>
     * @param \Google\Cloud\Dlp\V2\FieldId[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setQuasiIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Dlp\V2\FieldId::class);
        $this->quasi_ids = $arr;

        return $this;
    }

    /**
     * Sensitive field for computing the l-value.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId sensitive_attribute = 2;</code>
     * @return \Google\Cloud\Dlp\V2\FieldId
     */
    public function getSensitiveAttribute()
    {
        return $this->sensitive_attribute;
    }

    /**
     * Sensitive field for computing the l-value.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId sensitive_attribute = 2;</code>
     * @param \Google\Cloud\Dlp\V2\FieldId $var
     * @return $this
     */
    public function setSensitiveAttribute($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\FieldId::class);
        $this->sensitive_attribute = $var;

        return $this;
    }

}

