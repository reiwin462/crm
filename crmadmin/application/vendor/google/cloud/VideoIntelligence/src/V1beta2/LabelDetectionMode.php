<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/videointelligence/v1beta2/video_intelligence.proto

namespace Google\Cloud\VideoIntelligence\V1beta2;

/**
 * Label detection mode.
 *
 * Protobuf enum <code>Google\Cloud\Videointelligence\V1beta2\LabelDetectionMode</code>
 */
class LabelDetectionMode
{
    /**
     * Unspecified.
     *
     * Generated from protobuf enum <code>LABEL_DETECTION_MODE_UNSPECIFIED = 0;</code>
     */
    const LABEL_DETECTION_MODE_UNSPECIFIED = 0;
    /**
     * Detect shot-level labels.
     *
     * Generated from protobuf enum <code>SHOT_MODE = 1;</code>
     */
    const SHOT_MODE = 1;
    /**
     * Detect frame-level labels.
     *
     * Generated from protobuf enum <code>FRAME_MODE = 2;</code>
     */
    const FRAME_MODE = 2;
    /**
     * Detect both shot-level and frame-level labels.
     *
     * Generated from protobuf enum <code>SHOT_AND_FRAME_MODE = 3;</code>
     */
    const SHOT_AND_FRAME_MODE = 3;
}

