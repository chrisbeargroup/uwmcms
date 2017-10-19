<?php

namespace Drupal\uwmcs_reader\Controller;

// Change following https://www.drupal.org/node/2457593
// See https://www.drupal.org/node/2549395 for deprecate methods information
// use Drupal\Component\Utility\SafeMarkup;.
use Drupal\Component\Utility\Html;

// Use Html instead SAfeMarkup.
/**
 * Controller routines for UWMCS JSON Reader pages.
 */
class UwmcsReaderController {


  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function welcomePage() {
    $element = array(
      '#markup' => 'Hello, world',
    );

    return $element;
  }


  /**
   * Constructs UWMCS JSON Reader text with arguments.
   *
   * This callback is mapped to the path
   * 'uwmcs_reader/generate/{paragraphs}/{phrases}'.
   *
   * @param string $paragraphs
   *   The amount of paragraphs that need to be generated.
   * @param string $phrases
   *   The maximum amount of phrases that can be generated inside a paragraph.
   */
  public function generate($paragraphs, $phrases) {

    // Default settings.
    $config = \Drupal::config('uwmcs_reader.settings');
    // Page title and source text.
    $page_title = $config->get('uwmcs_reader.page_title');
    $source_text = $config->get('uwmcs_reader.source_text');

    $repertory = explode(PHP_EOL, $source_text);

    $element['#source_text'] = [];

    // Generate X paragraphs with up to Y phrases each.
    for ($i = 1; $i <= $paragraphs; $i++) {
      $this_paragraph = '';
      // When we say "up to Y phrases each", we can't mean "from 1 to Y".
      // So we go from halfway up.
      $random_phrases = mt_rand(round($phrases / 2), $phrases);
      // Also don't repeat the last phrase.
      $last_number = 0;
      $next_number = 0;
      for ($j = 1; $j <= $random_phrases; $j++) {
        do {
          $next_number = floor(mt_rand(0, count($repertory) - 1));
        } while ($next_number === $last_number && count($repertory) > 1);
        $this_paragraph .= $repertory[$next_number] . ' ';
        $last_number = $next_number;
      }
      // $element['#source_text'][] = SafeMarkup::checkPlain($this_paragraph);
      $element['#source_text'][] = Html::escape($this_paragraph);

    }

    // $element['#title'] = SafeMarkup::checkPlain($page_title);
    $element['#title'] = Html::escape($page_title);

    // Theme function.
    $element['#theme'] = 'uwmcs_reader';

    return $element;
  }

}
