<?php
declare(strict_types=1);

namespace Typofixer\Fixers;

use Typofixer\Typofixer;

/**
 * Replace multiple dots by ellipsis
*/
class Ellipsis extends Fixer
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(Typofixer $html)
    {
        $count = 0;

        foreach ($html->nodes(XML_TEXT_NODE) as $node) {
            //If the previous node has ellipsis, remove the possible left dots.
            //<strong>hello...</strong>. -> <strong>hello…</strong>
            if ($count !== 0) {
                $node->data = ltrim($node->data, '.');
            }

            $node->data = preg_replace('/\.{2,}/', '…', $node->data, -1, $count);
        }
    }
}
