<?php

namespace App\Infra\Serializer\Normalizer;

use App\Domain\Entity\Question;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;
use Symfony\Component\Serializer\SerializerAwareInterface;

/**
 * Class QuestionNormalizer
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class QuestionNormalizer implements NormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'label' => $object->getLabel(),
            'qcm' => $object->isQcm(),
            'category' => $object->getCategory()->getLabel(),
            'level' => $object->getLevel(),
            'answers' => $this->serializer->serialize($object->getAnswers(), $format, $context)
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Question;
    }
}
