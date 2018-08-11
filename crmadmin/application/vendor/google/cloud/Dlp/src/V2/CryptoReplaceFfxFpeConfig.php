<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Replaces an identifier with a surrogate using FPE with the FFX
 * mode of operation; however when used in the `ReidentifyContent` API method,
 * it serves the opposite function by reversing the surrogate back into
 * the original identifier.
 * The identifier must be encoded as ASCII.
 * For a given crypto key and context, the same identifier will be
 * replaced with the same surrogate.
 * Identifiers must be at least two characters long.
 * In the case that the identifier is the empty string, it will be skipped.
 * See [Pseudonymization](/dlp/docs/pseudonymization) for example usage.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.CryptoReplaceFfxFpeConfig</code>
 */
class CryptoReplaceFfxFpeConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * The key used by the encryption algorithm. [required]
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.CryptoKey crypto_key = 1;</code>
     */
    private $crypto_key = null;
    /**
     * The 'tweak', a context may be used for higher security since the same
     * identifier in two different contexts won't be given the same surrogate. If
     * the context is not set, a default tweak will be used.
     * If the context is set but:
     * 1. there is no record present when transforming a given value or
     * 1. the field is not present when transforming a given value,
     * a default tweak will be used.
     * Note that case (1) is expected when an `InfoTypeTransformation` is
     * applied to both structured and non-structured `ContentItem`s.
     * Currently, the referenced field may be of value type integer or string.
     * The tweak is constructed as a sequence of bytes in big endian byte order
     * such that:
     * - a 64 bit integer is encoded followed by a single byte of value 1
     * - a string is encoded in UTF-8 format followed by a single byte of value 2
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId context = 2;</code>
     */
    private $context = null;
    /**
     * The custom infoType to annotate the surrogate with.
     * This annotation will be applied to the surrogate by prefixing it with
     * the name of the custom infoType followed by the number of
     * characters comprising the surrogate. The following scheme defines the
     * format: info_type_name(surrogate_character_count):surrogate
     * For example, if the name of custom infoType is 'MY_TOKEN_INFO_TYPE' and
     * the surrogate is 'abc', the full replacement value
     * will be: 'MY_TOKEN_INFO_TYPE(3):abc'
     * This annotation identifies the surrogate when inspecting content using the
     * custom infoType
     * [`SurrogateType`](/dlp/docs/reference/rest/v2/InspectConfig#surrogatetype).
     * This facilitates reversal of the surrogate when it occurs in free text.
     * In order for inspection to work properly, the name of this infoType must
     * not occur naturally anywhere in your data; otherwise, inspection may
     * find a surrogate that does not correspond to an actual identifier.
     * Therefore, choose your custom infoType name carefully after considering
     * what your data looks like. One way to select a name that has a high chance
     * of yielding reliable detection is to include one or more unicode characters
     * that are highly improbable to exist in your data.
     * For example, assuming your data is entered from a regular ASCII keyboard,
     * the symbol with the hex code point 29DD might be used like so:
     * ⧝MY_TOKEN_TYPE
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InfoType surrogate_info_type = 8;</code>
     */
    private $surrogate_info_type = null;
    protected $alphabet;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * The key used by the encryption algorithm. [required]
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.CryptoKey crypto_key = 1;</code>
     * @return \Google\Cloud\Dlp\V2\CryptoKey
     */
    public function getCryptoKey()
    {
        return $this->crypto_key;
    }

    /**
     * The key used by the encryption algorithm. [required]
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.CryptoKey crypto_key = 1;</code>
     * @param \Google\Cloud\Dlp\V2\CryptoKey $var
     * @return $this
     */
    public function setCryptoKey($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\CryptoKey::class);
        $this->crypto_key = $var;

        return $this;
    }

    /**
     * The 'tweak', a context may be used for higher security since the same
     * identifier in two different contexts won't be given the same surrogate. If
     * the context is not set, a default tweak will be used.
     * If the context is set but:
     * 1. there is no record present when transforming a given value or
     * 1. the field is not present when transforming a given value,
     * a default tweak will be used.
     * Note that case (1) is expected when an `InfoTypeTransformation` is
     * applied to both structured and non-structured `ContentItem`s.
     * Currently, the referenced field may be of value type integer or string.
     * The tweak is constructed as a sequence of bytes in big endian byte order
     * such that:
     * - a 64 bit integer is encoded followed by a single byte of value 1
     * - a string is encoded in UTF-8 format followed by a single byte of value 2
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId context = 2;</code>
     * @return \Google\Cloud\Dlp\V2\FieldId
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * The 'tweak', a context may be used for higher security since the same
     * identifier in two different contexts won't be given the same surrogate. If
     * the context is not set, a default tweak will be used.
     * If the context is set but:
     * 1. there is no record present when transforming a given value or
     * 1. the field is not present when transforming a given value,
     * a default tweak will be used.
     * Note that case (1) is expected when an `InfoTypeTransformation` is
     * applied to both structured and non-structured `ContentItem`s.
     * Currently, the referenced field may be of value type integer or string.
     * The tweak is constructed as a sequence of bytes in big endian byte order
     * such that:
     * - a 64 bit integer is encoded followed by a single byte of value 1
     * - a string is encoded in UTF-8 format followed by a single byte of value 2
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId context = 2;</code>
     * @param \Google\Cloud\Dlp\V2\FieldId $var
     * @return $this
     */
    public function setContext($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\FieldId::class);
        $this->context = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.privacy.dlp.v2.CryptoReplaceFfxFpeConfig.FfxCommonNativeAlphabet common_alphabet = 4;</code>
     * @return int
     */
    public function getCommonAlphabet()
    {
        return $this->readOneof(4);
    }

    /**
     * Generated from protobuf field <code>.google.privacy.dlp.v2.CryptoReplaceFfxFpeConfig.FfxCommonNativeAlphabet common_alphabet = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setCommonAlphabet($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Dlp\V2\CryptoReplaceFfxFpeConfig_FfxCommonNativeAlphabet::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * This is supported by mapping these to the alphanumeric characters
     * that the FFX mode natively supports. This happens before/after
     * encryption/decryption.
     * Each character listed must appear only once.
     * Number of characters must be in the range [2, 62].
     * This must be encoded as ASCII.
     * The order of characters does not matter.
     *
     * Generated from protobuf field <code>string custom_alphabet = 5;</code>
     * @return string
     */
    public function getCustomAlphabet()
    {
        return $this->readOneof(5);
    }

    /**
     * This is supported by mapping these to the alphanumeric characters
     * that the FFX mode natively supports. This happens before/after
     * encryption/decryption.
     * Each character listed must appear only once.
     * Number of characters must be in the range [2, 62].
     * This must be encoded as ASCII.
     * The order of characters does not matter.
     *
     * Generated from protobuf field <code>string custom_alphabet = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setCustomAlphabet($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * The native way to select the alphabet. Must be in the range [2, 62].
     *
     * Generated from protobuf field <code>int32 radix = 6;</code>
     * @return int
     */
    public function getRadix()
    {
        return $this->readOneof(6);
    }

    /**
     * The native way to select the alphabet. Must be in the range [2, 62].
     *
     * Generated from protobuf field <code>int32 radix = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setRadix($var)
    {
        GPBUtil::checkInt32($var);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * The custom infoType to annotate the surrogate with.
     * This annotation will be applied to the surrogate by prefixing it with
     * the name of the custom infoType followed by the number of
     * characters comprising the surrogate. The following scheme defines the
     * format: info_type_name(surrogate_character_count):surrogate
     * For example, if the name of custom infoType is 'MY_TOKEN_INFO_TYPE' and
     * the surrogate is 'abc', the full replacement value
     * will be: 'MY_TOKEN_INFO_TYPE(3):abc'
     * This annotation identifies the surrogate when inspecting content using the
     * custom infoType
     * [`SurrogateType`](/dlp/docs/reference/rest/v2/InspectConfig#surrogatetype).
     * This facilitates reversal of the surrogate when it occurs in free text.
     * In order for inspection to work properly, the name of this infoType must
     * not occur naturally anywhere in your data; otherwise, inspection may
     * find a surrogate that does not correspond to an actual identifier.
     * Therefore, choose your custom infoType name carefully after considering
     * what your data looks like. One way to select a name that has a high chance
     * of yielding reliable detection is to include one or more unicode characters
     * that are highly improbable to exist in your data.
     * For example, assuming your data is entered from a regular ASCII keyboard,
     * the symbol with the hex code point 29DD might be used like so:
     * ⧝MY_TOKEN_TYPE
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InfoType surrogate_info_type = 8;</code>
     * @return \Google\Cloud\Dlp\V2\InfoType
     */
    public function getSurrogateInfoType()
    {
        return $this->surrogate_info_type;
    }

    /**
     * The custom infoType to annotate the surrogate with.
     * This annotation will be applied to the surrogate by prefixing it with
     * the name of the custom infoType followed by the number of
     * characters comprising the surrogate. The following scheme defines the
     * format: info_type_name(surrogate_character_count):surrogate
     * For example, if the name of custom infoType is 'MY_TOKEN_INFO_TYPE' and
     * the surrogate is 'abc', the full replacement value
     * will be: 'MY_TOKEN_INFO_TYPE(3):abc'
     * This annotation identifies the surrogate when inspecting content using the
     * custom infoType
     * [`SurrogateType`](/dlp/docs/reference/rest/v2/InspectConfig#surrogatetype).
     * This facilitates reversal of the surrogate when it occurs in free text.
     * In order for inspection to work properly, the name of this infoType must
     * not occur naturally anywhere in your data; otherwise, inspection may
     * find a surrogate that does not correspond to an actual identifier.
     * Therefore, choose your custom infoType name carefully after considering
     * what your data looks like. One way to select a name that has a high chance
     * of yielding reliable detection is to include one or more unicode characters
     * that are highly improbable to exist in your data.
     * For example, assuming your data is entered from a regular ASCII keyboard,
     * the symbol with the hex code point 29DD might be used like so:
     * ⧝MY_TOKEN_TYPE
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.InfoType surrogate_info_type = 8;</code>
     * @param \Google\Cloud\Dlp\V2\InfoType $var
     * @return $this
     */
    public function setSurrogateInfoType($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\InfoType::class);
        $this->surrogate_info_type = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlphabet()
    {
        return $this->whichOneof("alphabet");
    }

}
