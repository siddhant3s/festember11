<html>
<head>
<style type="text/css">
body{
background:black;
color:white;
border-width:medium;


}


</style>
<script src="jquery.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
</head>
<body bgcolor="lightgrey">
<div id="rulesBox"> 
 
  <h3>Blackjack Rules</h3> 
 
  <h4>Object</h4> 
 
  <p>Blackjack is a betting game played against a dealer. The object is score
  more points than the dealer without going over 21.</p> 
 
  <h4>Scoring</h4> 
 
  <p>Points are totaled for each card in a hand. Face cards (Jack, Queen and
  King) count as 10 points, Aces may be counted as either one or 11. All other
  cards are counted according to their numeric value.</p> 
 
  <p><i>When Aces are present in a hand, the total displayed to its right
  represents the highest score, not over 21, that could be made from those
  cards.</i></p> 
 
  <h4>Game Play</h4> 
 
  <p>To begin a round, the player places a bet (by hitting the "Deal" button)
  and both the player and the dealer are dealt two cards. The dealer's first
  card is dealt face down while all other cards are dealt face up.</p> 
 
  <p>If the first two cards in a hand total 21, it's called a "blackjack" or
  "natural." The player wins with a blackjack unless the dealer also has a
  blackjack. If the dealer has a blackjack and the player doesn't, the player
  loses. If both have a blackjack, it is a tie ("push"). In any case, the round
  is over.</p> 
 
  <p>When neither the dealer nor the player have blackjack, the player may take
  additional cards, one at a time ("hit"), until he or she reaches 21 or goes
  over ("busts"). The player may stop at any time ("stand"). The player loses
  if he or she busts.</p> 
 
  <p>Otherwise, once the player stands, it is the dealer's turn and the
  dealer's down card is revealed. The dealer must hit if the point total is
  less than 17 and continue hitting until reaching 17 or more. If the dealer
  busts, the player wins.</p> 
 
  <p>If neither the player or dealer busts, the player wins if his or her total
  is higher than the dealer's. If they tie, it is a push.</p> 
 
  <h4>Betting</h4> 
 
  <p>The player starts with $1000.00 credit (strictly play money) and may bet
  any amount between $5.00 and $100.00 in increments of $5.00. The player may
  change this bet amount between rounds.</p> 
 
  <p>If the player wins with a blackjack, his or her bet is paid off at 3 to 2.
  Otherwise, the player is paid even money for a win. In the event of a push,
  the player's bet is returned.</p> 
 
  <p>Note that a hand of three or more cards totaling 21 is not considered
  a blackjack. That is, if the player reaches 21 by hitting on a hand it is not
  an automatic win. If the player does win with such a hand, the bet is paid at
  even money.</p> 
 
  <h4>Special Plays</h4> 
 
  <p>After the initial deal, if neither the player nor dealer has a blackjack,
  the player has some additional options:</p> 
 
  <ul> 
    <li>The player may "split" if he or she has a pair (two cards of identical
    value, this includes any two face cards or a ten and any face card). See
    <i>Splits</i> below for details.</li> 
    <li>The player may "double down," meaning that the player doubles his or
    her current bet and receives one and only one additional card.</li> 
    <li>The player may "surrender," forfeiting the round and losing half of his
    or her original bet.</li> 
  </ul> 
 
  <p><i>Buttons are automatically enabled and disabled depending on what
  actions or options are valid at any point in the game according to the
  rules.</i></p> 
 
  <h4>Insurance</h4> 
 
  <p>On the initial deal, if the dealer's up card is an Ace, the player is
  offered "insurance." This is a side bet equal to half of the player's
  original bet. If the player buys insurance and the dealer has blackjack, the
  player is paid 2 to 1 on this side bet. If the player buys insurance and the
  dealer does not have blackjack, the side bet is lost. In either case, the
  round continues as before with the player's original bet.</p> 
 
  <p><i>When prompted to buy insurance, click "OK" to purchase or "Cancel"
  to decline.</i></p> 
 
  <h4>Splits</h4> 
 
  <p>When the player is dealt a pair, he or she may split. One card is removed
  and placed in a new hand with a bet equal to the amount of the player's
  original bet.</p> 
 
  <p>The split hands are then played individually as follows:</p> 
 
  <ul> 
    <li>An additional card is dealt to the hand.</li> 
    <li>If Aces are split, only one additional card is given to each hand (see
    <i>House Rules</i> below). The player may not hit, split or double down
    afterwards.</li> 
    <li>Otherwise, after the second card has been dealt the hand may be played
    as before (hit, stand, double down, etc.) except that the player may not
    surrender on a split hand.</li> 
    <li>Pairs (other than Aces) may be resplit but there is a limit to the
    total number of times the player can split (see <i>House Rules</i> 
    below).</li> 
  </ul> 
 
  <p>Once the player completes the first split hand (stands, doubles down or
  busts), the next hand is played and so on until all split hands have been
  played. Play then moves to the dealer as before.</p> 
 
  <p>Note: If the additional card dealt to a split hand makes a total of 21, it
  is <i>not</i> considered a blackjack. In other words, it will pay at even
  money if the hand wins.</p> 
 
  <p><i>When the player splits, the hand currently in play will be
  highlighted.</i></p> 
 
  <p>Once the dealer busts or stands, each split hand is individually compared
  to the dealer's to determine a win, loss or push for the player. It is
  possible, for example, to beat the dealer on one hand but lose on the
  other.</p> 
 
  <h4>House Rules</h4> 
 
  <p>Blackjack rules can vary. The rules used in this game are based on typical
  Las Vegas casino rules:</p> 
 
  <ul> 
    <li>A four deck shoe is used. The player is notified whenever a new deck is
    put into play.</li> 
    <li>The dealer may not hit on a soft 17, that is, when the dealer has a
    total of 17 using an Ace counted as 11.</li> 
    <li>The player may double down on any initial two card hand.</li> 
    <li>The player may split up to three times in any round (giving a possible
    total of four separate hands).</li> 
    <li>If the player splits on Aces, only one additional card will be dealt to
    each split hand.</li> 
    <li>Aces may not be resplit.</li> 
  </ul> 
 
</div> 
</body>
</html>