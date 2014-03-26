<header>
	<small>Company address</small><br />
	<?php if (! empty($customer->company)) echo $customer->company . '<br />'; ?>
	<?php if (! empty($customer->name)) echo $customer->name . '<br />'; ?>
	<?php if (! empty($customer->addition)) echo $customer->addition . '<br />'; ?>
	<?php if (! empty($customer->addition2)) echo $customer->addition2 . '<br />'; ?>
	<?=$customer->street . ' ' . $customer->street_no ?><br />
	<?=$customer->zip_code . ' ' . $customer->city ?><br />
</header>

<h1>Gutschrift</h1>

<table class="mt5 mb5">
	<thead>
	<tr>
		<th class="left">Liefertermin</th>
		<th class="left">Auftrag vom</th>
		<th class="left">Datum</th>
		<th class="right">RE-Nummer</th>
	</tr>
	</thead>
	<tbody class="border-top">
	<tr>
		<td class="left"><?=date('d.m.Y') ?></td>
		<td class="left"><?=date('d.m.Y', strtotime($invoice->invoice_date)) ?></td>
		<td class="left"><?=date('d.m.Y') ?></td>
		<td class="right"><?=$invoice->invoice_no ?></td>
	</tr>
	</tbody>
</table>

<p>Die nachfolgend beschriebenen Artikel und Leistungen schreiben wir Ihnen gut.</p>

<?php foreach ($pages as $page_no => $page) : ?>

<?php if ($page_no > 1): ?>
<div class="page-break"></div>

<table class="mt5 mb5">
	<colgroup>
		<col width="20%">
		<col width="30%">
		<col width="25%">
		<col width="25%">
	</colgroup>
	<tbody>
	<tr>
		<td>Seite <?=$page_no ?></td>
		<td>RE-Nummer <?=$invoice->invoice_no ?></td>
		<td>Datum <?=date('d.m.Y') ?></td>
		<td class="right"><?php if (isset($carryover[$page_no])) echo 'Übertrag: ' . $carryover[$page_no]; ?></td>
	</tr>
	</tbody>
</table>
<?php endif; ?>

<table class="mt5 spacing position-tables">
	<colgroup>
		<col width="10%">
		<col width="60%">
		<col width="15%">
		<col width="15%">
	</colgroup>
	<thead class="border-top border-bottom">
	<tr>
		<th class="left">Menge</th>
		<th class="left">Bezeichnung</th>
		<th class="right">EP</th>
		<th class="right">GP</th>
	</tr>
	</thead>
	<tbody class="border-top">
	<?php foreach ($page as $position) : ?>
	<tr>
		<td class="left"><?=number_format($position['amount'], 2, '.', '') ?></td>
		<td class="left"><?=$position['description'] ?></td>
		<td class="right"><?=$position['ep'] ?></td>
		<td class="right"><?=$position['gp'] ?></td>
	</tr>
	<?php endforeach ?>
	</tbody>
</table>
<?php endforeach ?>

<table id="total-money-table" class="mt5 spacing">
	<colgroup>
		<col width="40%">
		<col width="30%">
		<col width="30%">
	</colgroup>
	<thead class="border-top border-bottom">
	<tr>
		<th class="right">Summe Netto in &euro;</th>
		<th class="right">MwSt 19% in &euro;</th>
		<th class="right">GESAMTBETRAG in &euro;</th>
	</tr>
	</thead>
	<tbody class="border-top">
	<tr>
		<td class="right"><?=number_format($total, 2, '.', ' ') ?></td>
		<td class="right"><?=number_format($total * 0.19, 2, '.', ' ') ?></td>
		<td class="right"><?=number_format($total * 1.19, 2, '.', ' ') ?></td>
	</tr>
	</tbody>
</table>

<script>
	window.addEvent('domready', function() {
		// Prepare the print view (break pages etc.)
		prepare_print_view();

		// And call the print-dialog, if available.
		if (window.print) window.print();
	});

	function prepare_print_view () {
		// Nothing to do here.
	}
</script>